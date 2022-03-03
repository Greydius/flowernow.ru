<?php

namespace App\Model;

use App\MainModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use App\Model\PromoCode;
use App\Model\SingleProduct;

class Product extends MainModel
{
    //
        use SoftDeletes;

        protected $table = '';

        public function __construct($order = '')
        {
                parent::__construct();

                if ($order) {
                    $tablename = 'products_' . $order;
                } else {
                    $tablename = 'products';
                }
                $this->setTable($tablename);
        }

        protected $dates = ['deleted_at'];

        protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

        protected $appends = ['clientPrice', 'url', 'photoUrl', 'fullPrice', 'deliveryTime'];

        public $promoCode;

        public static $hiddenApi = [
                'clientPrice', 'shop', 'deliveryTime', 'fullPrice', 'slug', 'shop_id'
        ];

        public static $photoRules = [
                'file' => 'required | mimes:jpeg,jpg,png,PNG,JPEG,JPG | max:15000',
        ];

        public  static $photoRulesMessages = [
                'file.required' => 'Выберите файл',
                'file.mimes' => 'Неверный формат файла. Требуется *.jpg *.jpeg *.png',
                'file.max' => 'Файл не должен больше 15Мб',
        ];

        public static $productRules = [
                'name' => 'required',
                'price' => 'required | integer',
                'product_type_id' => 'required | integer',
                'make_time' => 'required',
                'width' => 'required',
                'height' => 'required',
                'description' => 'required',
        ];

        public  static $productRulesMessages = [
                'name.required' => 'Имя не может быть пустым',
                'price.required' => 'Введите цену',
                'price.integer' => 'Цена должна быть целым числом',
                'product_type_id.required' => 'Укажите тип',
                'product_type_id.integer' => 'Укажите тип',
                'make_time.required' => 'Выберите время изготовления',
                'width.required' => 'Введите ширину',
                'height.required' => 'Введите высоту',
                'description.required' => 'Введите описание',
        ];

        public static $productDopRules = [
                'name' => 'required',
                'price' => 'required | integer'
        ];

        public  static $productDopRulesMessages = [
                'name.required' => 'Имя не может быть пустым',
                'price.required' => 'Введите цену',
                'price.integer' => 'Цена должна быть целым числом'
        ];

        public static $fileUrl = '/uploads/products/';

        public static function getNewProductName($shop_id, $dop = 0) {

                $productsCount = self::where('shop_id', $shop_id)->count();
                $productName = (!$dop ? 'Букет №' : 'Товар №').($productsCount+1);

                return $productName;
        }

        public static function getNewProductSlug($productName) {
                $slugExist = false;
                $productSlug = '';

                while (!$slugExist) {
                        $productSlug = str_slug($productName).'-'.rand(100, 999);
                        $productsCount = self::where('slug', $productSlug)->count();
                        if($productsCount) {
                                $productName = $productName.'-'.time().rand(100, 999);
                        } else {
                                $slugExist = true;
                        }
                }

                return $productSlug;
        }

        function shop() {
                return $this->belongsTo('App\Model\Shop');
        }

        function singleProduct() {
                return $this->belongsTo('App\Model\SingleProduct', 'single');
        }

        function color() {
                return $this->belongsTo('App\Model\Color');
        }

        function productType() {
                return $this->belongsTo('App\Model\ProductType');
        }

        function orderList() {
                return $this->hasMany('App\Model\OrderList');
        }

        // relation for products
        function compositions() {
                return $this->hasMany('App\Model\ProductComposition');
        }

        // relation for photos
        function photos() {
                return $this->hasMany('App\Model\ProductPhoto')->orderBy('priority');
        }

        static function popular($city_id = null, Request $request = null, $page = 1, $perPage = 15, $isMain = false) {

                $fakeShop = Shop::where('city_id', $city_id)->where('copy_id', 350)->first();
                $shops = Shop::where('city_id', $city_id)->pluck('id')->toArray();

                $currentPage = $page;
                $productRequest = self::with(['shop'  => function($query) use($city_id) {
                        $query->select(['id', 'name', 'delivery_price', 'delivery_time', 'city_id']);
                }, 'photos', 'compositions.flower']);

                if($fakeShop) {
                        $shops[] = $fakeShop->id;
                }

                $productRequest->whereIn('shop_id', $shops);
                
                $productRequest->where('price', '>', 0)
                        ->where('dop', 0)
                        ->where('status', 1)
                        ->where('pause', 0)
                        ->whereNull('single');

                if(!empty($request)) {

                        if($request->deleted) {
                                $productRequest->onlyTrashed();
                        }

                        if(!empty($request->notIn)) {
                                $productRequest->whereNotIn('id', $request->notIn);
                        }

                        if(!empty($request->productType)) {
                                $productRequest->where('product_type_id', (int)$request->productType);
                        }

                        if(!empty($request->product_type) && $request->product_type != 'all') {
                                
                                $productType = ProductType::where('slug', $request->product_type)->first();
                                $productRequest->where('product_type_id', (int)$productType->id);

                        }

                                      if(!empty($request->productPrice)) {
                                              $price = Price::find($request->productPrice);
                                              if(!empty($price)) {
                                                      $productRequest->whereRaw('price+(SELECT delivery_price FROM shops WHERE shops.id = products.shop_id)*' . (1+(config('settings.product_commission')/100)) . '  BETWEEN '.(int)$price->price_from.' AND '.(int)$price->price_to);
                                              }
                                      }

                                      if(!empty($request->price_from)) {
                                              $productRequest->whereRaw('(price +(SELECT delivery_price FROM shops WHERE shops.id = products.shop_id))*' . (1+(config('settings.product_commission')/100)) . ' >= '.(int)$request->price_from.' ');
                                      }

                                      if(!empty($request->price_to)) {
                                              $productRequest->whereRaw('(price +(SELECT delivery_price FROM shops WHERE shops.id = products.shop_id))*' . (1+(config('settings.product_commission')/100)) . ' <= '.(int)$request->price_to.' ');
                                      }

                                      if(!empty($request->flowers)) {

                                              $flowers = Flower::whereIn('id', $request->flowers)->get();

                                              $flowersSearchKeys = [];
                                              if(!empty($flowers)) {
                                                      foreach($flowers as $flower) {
                                                              if(!empty($flower->search_key)) {
                                                                      $flowersSearchKeys = array_merge($flowersSearchKeys, explode(',', $flower->search_key));
                                                              }
                                                      }
                                              }

                                              //dd($flowersSearchKeys);

                                              $productRequest->where(function ($query) use ($request, $flowersSearchKeys) {
                                                      $query->whereHas('compositions', function($query) use ($request) {
                                                              $query->whereIn('flower_id', $request->flowers);
                                                      });

                                                      foreach($flowersSearchKeys as $pk) {
                                                              $query->orWhere('name', 'like', '%'.$pk.'%')
                                                                      ->orWhere('description', 'like', '%'.$pk.'%');
                                                      }
                                              });

                                              /*
                                              $productRequest->whereHas('compositions', function($query) use ($request) {
                                                      $query->whereIn('flower_id', $request->flowers);
                                              });
                                              */

                                      }

                                      /*
                                      if(!empty($request->flower)) {
                                              $productRequest->whereHas('productType', function($query) use ($request) {
                                                      $query->where('slug', $request->product_type);
                                              });
                                      }
                                      */

                                      if(!empty($request->color)) {

                                              $productRequest->where('color_id', (int)$request->color);
                                      }

                                      if(!empty($request->shop_id)) {

                                              $productRequest->where('shop_id', (int)$request->shop_id);
                                      }

                                      if(!empty($request->order)) {
                                              if($request->order == 'price') {
                                                      $productRequest->orderByRaw('(price + (SELECT delivery_price FROM shops WHERE shops.id = products.shop_id))');
                                                      $productRequest->whereNotIn('product_type_id', [7, 8, 9, 10]);
                                              } elseif($request->order == 'rand') {
                                                      $productRequest->orderBy(\DB::raw('RAND()'));
                                              }

                                              //$productRequest->appends($request->order);

                                      } else {
                                              $productRequest->orderBy('star', 'DESC');
                                      }

                                      if(!empty($request->q)) {

                                              $queryString = $request->q;
                                              $queryString = str_replace(',', ' ', $queryString);
                                              $queryString = str_replace('.', ' ', $queryString);
                                              $queryString = str_replace('-', ' ', $queryString);
                                              $queryString = str_replace('+', ' ', $queryString);
                                              $queryString = str_replace('/', ' ', $queryString);
                                              $queryString = preg_replace('!\s+!', ' ', $queryString);
                                              $queries = explode(' ', $queryString);


                                              if(!empty($queries)) {

                                                      $flowersBuilder = Flower::where('name', 'like', '%'.$queries[0].'%')->orWhere('search_key', 'like', '%'.$queries[0].'%');
                                                      for($i=1; $i<count($queries); $i++) {
                                                              if(strlen($queries[$i]) > 1) {
                                                                      $flowersBuilder->orWhere('name', 'like', '%'.$queries[$i].'%')->orWhere('search_key', 'like', '%'.$queries[$i].'%');
                                                              }
                                                      }

                                                      $flowers = $flowersBuilder->get();

                                                      $flowersSearchKeys = [];
                                                      if(!empty($flowers)) {
                                                              foreach($flowers as $flower) {
                                                                      $flowersSearchKeys[] = $flower->id;
                                                              }
                                                      }

                                                      if(!empty($flowersSearchKeys)) {
                                                              $productRequest->where(function ($query) use ($request, $flowersSearchKeys, $queries) {
                                                                      $query->whereHas('compositions', function($query) use ($request, $flowersSearchKeys) {
                                                                              $query->whereIn('flower_id', $flowersSearchKeys);
                                                                      });

                                                                      foreach($queries as $pk) {
                                                                              $query->orWhere(function ($query) use ($request, $pk) {
                                                                                      $query->orWhere('name', 'like', '%'.$pk.'%')
                                                                                              ->orWhere('description', 'like', '%'.$pk.'%');
                                                                              });
                                                                      }
                                                              });
                                                      } else {
                                                              foreach($queries as $pk) {
                                                                      $productRequest->where(function ($query) use ($request, $pk) {
                                                                              $query->Where('name', 'like', '%'.$pk.'%')
                                                                                      ->orWhere('description', 'like', '%'.$pk.'%');
                                                                      });
                                                              }
                                                      }


                                              }
                                      }
                              }

                              Paginator::currentPageResolver(function () use ($currentPage) {
                                      return $currentPage;
                              });

                              //echo $productRequest->toSql(); exit();

                              if(!empty($request->shop_id) && $request->shop_id == 499) {
                                      //echo $productRequest->toSql(); exit();
                                      //echo $city_id; exit();
                              }

                              if(!empty($request->t)) {
                                      //dd($request);
                                      echo $productRequest->toSql(); exit();
                                      //echo $city_id; exit();
                              }

                        //       if($isMain) {
                        //         $productRequestwhere->orderBy('price', 'asc');
                        //       }

                              $products = $productRequest->simplePaginate($perPage);

                              return $products;

                              /*
                              return \DB::table('products')
                                      ->select('products.*', 'shops.name AS shop_name')
                                      ->join('shops', 'shops.id', '=', 'products.shop_id')
                                      ->where('shops.city_id', $city_id)
                                      ->where('price', '>', 0)->get();
                              */
                      }

        public function getClientPriceAttribute() {

                $price = $this->fullPrice;

                if(!empty($this->promoCode)) {
                        if($this->promoCode->code_type == 'sum') {
                                return $price - $this->promoCode->value;
                        }

                        if($this->promoCode->code_type == 'percent') {
                                return ceil($price * ((100 - $this->promoCode->value)/100) );
                        }
                }

                return $price;
        }

        public function getFullPriceAttribute() {
                if($this->dop) {
                        return $this->price;
                }

                if(!$this->shop) {
                        return ceil(ceil($this->price));
                }

                if(empty($this->single)) {
                        return ceil(ceil($this->price + $this->shop->delivery_price));
                }

                $singleProduct = $this->singleProduct()->first();
                $qty = !empty($this->qty) ? $this->qty : $singleProduct->qty_from;
                return ceil(ceil($this->price * $qty + $this->shop->delivery_price));
        }

        public function getUrlAttribute() {

                return route('product.show', ['slug' => $this->slug]);
        }

        public function getPhotoUrlAttribute() {

                if(empty($this->single)) {
                        /*
                        if(!empty($this->photos[0]->cdn_response)) {
                                return('https://res.cloudinary.com/floristum/image/upload/350x350/'.$this->shop_id.'/'.$this->photos[0]->photo);
                        }
                        */

                        //return secure_asset('/uploads/products/632x632/'.$this->shop_id.'/'.$this->photo.'');
                        if($this->copy_id != null){
                          return \App\Helpers\AppHelper::RESIZER('/uploads/products/350/'.$this->photo, 351, 351, 1, NULL, 75);
                        } elseif($this->shop_copy_id != null) {
                          return \App\Helpers\AppHelper::RESIZER('/uploads/products/'.$this->shop_copy_id.'/'.$this->photo, 351, 351, 1, NULL, 75);
                        }else {
                          return \App\Helpers\AppHelper::RESIZER('/uploads/products/'.$this->shop_id.'/'.$this->photo, 351, 351, 1, NULL, 75);
                        }
                }

                //return secure_asset('/uploads/single/632x632/'.$this->photo.'');
                return \App\Helpers\AppHelper::RESIZER('/uploads/single/632x632/'.$this->photo, 351, 351, 1, NULL, 75);

                //return secure_asset('/uploads/single/'.$this->photo.'');
                //return secure_asset('https://via.placeholder.com/600x600');
        }

        public function getDeliveryTimeAttribute() {

                $return = '';

                if($this->make_time) {
                        $hours = floor($this->make_time / 60);
                        $minutes = $this->make_time % 60;

                        $return .= ($hours ? $hours .'ч.' : '');
                        $return .= ($minutes ? ' '.$minutes .'мин.' : '');
                }

                return $return;
        }

        public function setPromoCode($promoCode) {
                if(!empty($promoCode)) {
                        $this->promoCode = PromoCode::where('code', $promoCode)->where(function ($query) {
                            $query->whereNull('used_on')->orWhere('reusable', 1);
                        })->first();
                } else {
                        $this->promoCode = null;
                }
        }

        public static function randProducts($city_id) {
                return Product::whereRaw('products.shop_id IN (select shops.id from `shops` where `city_id` = '.(int)$city_id.'  and `active` = 1 and (`delivery_price` > 0 or `delivery_free` = 1))')
                /*whereHas('shop', function($query) use ($city_id) {
                        $query->where('city_id', $city_id)->available();
                })*/
                        ->where('price', '>', 0)
                        ->where('status', 1)
                        ->where('pause', 0)
                        ->whereNotIn('product_type_id', [7, 8, 9, 10])
                        ->whereNull('single');
                        // ->inRandomOrder();
        }

        public static function validateField($fieldName, $fieldValue) {
                $response = [
                        'valid' => true
                ];
                $validator = \Illuminate\Support\Facades\Validator::make([$fieldName => $fieldValue], [$fieldName => self::$productRules[$fieldName]], self::$productRulesMessages);
                if($validator->fails()) {
                        $response['valid'] = false;
                        $response['message'] = $validator->messages()->first();
                }

                return $response;
        }
}

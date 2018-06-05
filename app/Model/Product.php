<?php

namespace App\Model;

use App\MainModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use App\Model\PromoCode;

class Product extends MainModel
{
    //
        use SoftDeletes;

        protected $dates = ['deleted_at'];

        protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

        protected $appends = ['clientPrice', 'url', 'photoUrl', 'fullPrice'];

        public $promoCode;

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

        // relation for products
        function compositions() {
                return $this->hasMany('App\Model\ProductComposition');
        }

        // relation for photos
        function photos() {
                return $this->hasMany('App\Model\ProductPhoto')->orderBy('priority');
        }

        static function popular($city_id = null, Request $request = null, $page = 1, $perPage = 15) {

                $currentPage = $page;

                if(!empty($request->single)) {
                        $singleProductsIds = [2, 23, 194, 40, 194, 84, 56, 16, 21, 70,
                        105, //красных тюльпанов
                        97, //красных гвоздик
                        116, //красных пионов
                        130, //разноцветных ирисов
                        //138, //белых калл
                        171, //белых фрезий
                        183, //белых гортензий
                        166 //белых анемонов
                        ];
                        $request->product_type = 'klassika';
                        return self::popularSingle2($city_id, $singleProductsIds)->paginate($perPage);
                }

                $productRequest = self::with(['shop'  => function($query) {
                            $query->select(['id', 'name', 'delivery_price', 'delivery_time']);
                        }])->whereHas('shop', function($query) use ($city_id) {
                                $query->where('city_id', $city_id)->available();
                        })->where('price', '>', 0)
                        ->where('dop', 0)
                        ->where('status', 1)
                        ->where('pause', 0)
                        ->whereNull('single');

                if(!empty($request)) {
                        if(!empty($request->productType)) {
                                $productRequest->where('product_type_id', (int)$request->productType);
                        }

                        if(!empty($request->product_type) && $request->product_type != 'all') {
                                $productRequest->whereHas('productType', function($query) use ($request) {
                                        $query->where('slug', $request->product_type);
                                });
                        }

                        if(!empty($request->productPrice)) {
                                $price = Price::find($request->productPrice);
                                if(!empty($price)) {
                                        $productRequest->whereRaw('get_client_price(price, shop_id) BETWEEN '.(int)$price->price_from.' AND '.(int)$price->price_to);
                                }
                        }

                        if(!empty($request->price_from)) {
                                $productRequest->whereRaw('get_client_price(price, shop_id) >= '.(int)$request->price_from.' ');
                        }

                        if(!empty($request->price_to)) {
                                $productRequest->whereRaw('get_client_price(price, shop_id) <= '.(int)$request->price_to.' ');
                        }

                        if(!empty($request->flowers)) {

                                $productRequest->whereHas('compositions', function($query) use ($request) {
                                        $query->whereIn('flower_id', $request->flowers);
                                });
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
                                }

                                //$productRequest->appends($request->order);
                        } else {
                                $productRequest->orderBy('sort', 'DESC');
                        }
                }

                Paginator::currentPageResolver(function () use ($currentPage) {
                        return $currentPage;
                });

                //echo $productRequest->toSql(); exit();

                $products = $productRequest->paginate($perPage);

                return $products;

                /*
                return \DB::table('products')
                        ->select('products.*', 'shops.name AS shop_name')
                        ->join('shops', 'shops.id', '=', 'products.shop_id')
                        ->where('shops.city_id', $city_id)
                        ->where('price', '>', 0)->get();
                */
        }

        static function popularSingle2($city_id, $ids = [], $orderRand = false) {
                $_products = Product::with(['shop' => function ($query) {
                        $query->select(['id', 'name', 'delivery_price', 'delivery_time']);
                }])->join(\DB::raw('
                (SELECT MIN(p.id) AS id, p.single FROM products p  
                INNER JOIN shops ON shops.id = p.shop_id
                INNER JOIN 
                (SELECT products.single, MIN(products.price + shops.delivery_price) AS min_price
                FROM products 
                INNER JOIN shops ON shops.id = products.shop_id
                WHERE shops.city_id = ' . (int)$city_id . '
                AND products.status = 1 
                AND products.pause = 0 
                AND products.price > 0 
                AND products.single IN (' . implode(',', $ids) . ')                
                GROUP BY single) AS single ON single.single = p.single AND single.min_price = (p.price + shops.delivery_price)
                WHERE shops.city_id = ' . (int)$city_id . '
                AND p.status = 1 
                AND p.pause = 0 
                AND p.price > 0 
                AND p.single IN (' . implode(',', $ids) . ') GROUP BY p.single) AS single2
            '), function ($join) {
                        $join->on('products.id', '=', 'single2.id');
                })->whereHas('shop', function ($query) use ($city_id) {
                        $query->where('city_id', $city_id)->available();
                });
                
                if($orderRand) {
                        $_products->orderBy(\DB::raw('RAND()'));
                } else {
                        $_products->orderByRaw(\DB::raw("FIELD(products.single, " . implode(',', $ids) . ")"));
                }

             return $_products;
        }

        static function popularSingle($city_id, $ids = []) {





                $_products = self::with(['shop'  => function($query) {
                            $query->select(['id', 'name', 'delivery_price']);
                        }])->whereHas('shop', function($query) use ($city_id) {
                                $query->where('city_id', $city_id)->available();
                        })->where('price', '>', 0)
                        ->where('status', 1)
                        ->where('pause', 0)
                        ->whereIn('single', $ids)
                        ->orderBy(\DB::raw('RAND()'))->limit(6)->get();



                return $_products;

/*
                $_products = Product::with(['shop' => function ($query) {
                        $query->select(['id', 'name', 'delivery_price']);
                }])->join(\DB::raw('
                        (SELECT products.id, products.single, MIN(products.price)
                        FROM products 
                        INNER JOIN shops ON shops.id = products.shop_id  and shops.`city_id` = '.(int)$city_id.'
                        WHERE products.status = 1 AND products.pause = 0 AND products.price > 0 AND products.single IN (' . implode(',', $ids) . ')
                        GROUP BY products.single) AS single
                    '), function ($join) {
                        $join->on('products.id', '=', 'single.id');
                })->get();
*/


                $products = [];
                foreach ($_products as $item) {
                        if(empty($products[$item->single])) {
                                $products[$item->single] = $item;
                        }
                }

                $returnProducts = [];
                foreach ($_products as $item) {
                        $returnProducts[] = $item;
                }

                return $returnProducts;
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

                if(empty($this->single)) {
                        return ceil(ceil($this->price * (1+(config('settings.product_commission')/100))) + $this->shop->delivery_price);
                }

                $singleProduct = $this->singleProduct()->first();
                $qty = !empty($this->qty) ? $this->qty : $singleProduct->qty_from;
                return ceil(ceil($this->price * $qty * (1+(config('settings.single_product_commission')/100))) + $this->shop->delivery_price);
        }

        public function getUrlAttribute() {

                return route('product.show', ['slug' => $this->slug]);
        }

        public function getPhotoUrlAttribute() {

                if(empty($this->single)) {
                        return asset('/uploads/products/632x632/'.$this->shop_id.'/'.$this->photo.'');
                }

                return asset('/uploads/single/'.$this->photo.'');
                //return asset('http://via.placeholder.com/600x600');
        }

        public function getDeliveryTimeAttribute() {

                $return = '';

                if($this->make_time) {
                        $hours = floor($this->make_time / 60);
                        $minutes = $this->make_time % 60;

                        $return .= ($hours ? $hours .'ч. ' : '');
                        $return .= ($minutes ? $minutes .'мин.' : '');
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
}

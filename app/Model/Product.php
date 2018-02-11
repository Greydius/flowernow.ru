<?php

namespace App\Model;

use App\MainModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;

class Product extends MainModel
{
    //
        use SoftDeletes;

        protected $dates = ['deleted_at'];

        protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

        protected $appends = ['clientPrice', 'url', 'photoUrl'];

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
        ];

        public  static $productRulesMessages = [
                'name.required' => 'Имя не может быть пустым',
                'price.required' => 'Введите цену',
                'price.integer' => 'Цена должна быть целым числом',
                'product_type_id.required' => 'Укажите тип',
                'product_type_id.integer' => 'Укажите тип'
        ];

        public static $fileUrl = '/uploads/products/';

        public static function getNewProductName($shop_id) {

                $productsCount = self::where('shop_id', $shop_id)->count();
                $productName = 'Букет №'.($productsCount+1);

                return $productName;
        }

        public static function getNewProductSlug($productName) {
                $slugExist = false;
                $productSlug = '';

                while (!$slugExist) {
                        $productSlug = str_slug($productName);
                        $productsCount = self::where('slug', $productSlug)->count();
                        if($productsCount) {
                                $productName = $productName.'_'.time();
                        } else {
                                $slugExist = true;
                        }
                }

                return $productSlug;
        }

        function shop() {
                return $this->belongsTo('App\Model\Shop');
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

                $productRequest = self::with('shop')->whereHas('shop', function($query) use ($city_id) {
                        $query->where('city_id', $city_id);
                })->where('price', '>', 0);

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

        public function getClientPriceAttribute() {
                return ceil($this->price * 1.2);
        }

        public function getUrlAttribute() {

                return route('product.show', ['slug' => $this->slug]);
        }

        public function getPhotoUrlAttribute() {

                return asset('/uploads/products/632x632/'.$this->shop_id.'/'.$this->photo.'');
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
}

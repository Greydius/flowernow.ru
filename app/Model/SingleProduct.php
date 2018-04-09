<?php

namespace App\Model;

use App\MainModel;
use App\Model\Product;

class SingleProduct extends MainModel
{
    //

        public function parent() {
                return $this->belongsTo('App\Model\SingleProduct', 'parent_id');
        }

        public static function mainCategory() {
                return self::whereNull('parent_id')->get();
        }

        public static function copyProductsToShop($shopId) {
                $products = self::whereNotNull('parent_id')->get();
                foreach ($products as $item) {
                        if(!Product::where('shop_id', $shopId)->where('single', $item->id)->count()) {
                                $product = new Product();
                                $product->shop_id = $shopId;
                                $product->single = $item->id;
                                $product->name = $item->name;
                                $product->slug = $shopId.'-'.$item->slug;
                                $product->description = $item->description;
                                $product->photo = $item->photo;
                                $product->width = $item->width;
                                $product->height = $item->height;
                                $product->color_id = $item->color_id;
                                $product->product_type_id = $item->product_type_id;
                                $product->save();
                        }
                }
        }
}

<?php

namespace App\Model;

use App\MainModel;

class ProductType extends MainModel
{
    //
        protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

        public function product() {
                return $this->hasMany('App\Model\Product');
        }

        public function scopeInCity($query, $city_id) {
                $query->whereHas('product', function($_query) use ($city_id) {
                        $_query->whereHas('shop', function($_sub_query) use ($city_id) {
                                $_sub_query->where('city_id', $city_id)->available();
                        })->where('price', '>', 0)
                        ->where('dop', 0)
                        ->where('status', 1)
                        ->where('pause', 0)
                        ->whereNull('single');
                });

                return $query;
        }
}

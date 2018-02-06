<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShopAddress extends Model
{
    //
        use SoftDeletes;

        protected $dates = ['deleted_at'];

        public function shop() {
                return $this->belongsTo('App\Model\Shop');
        }
}

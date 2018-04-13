<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    //

        // relation for product
        function product() {
                return $this->belongsTo('App\Model\Product');
        }

        // relation for shop
        function shop() {
                return $this->belongsTo('App\Model\Shop');
        }
}

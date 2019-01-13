<?php

namespace App\Model;

use App\MainModel;

class Banner extends MainModel
{
    //

        // relation for shop
        function shop() {
                return $this->belongsTo('App\Model\Shop');
        }
}

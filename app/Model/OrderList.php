<?php

namespace App\Model;

use App\MainModel;

class OrderList extends MainModel
{
    //
        // relation for product
        function product() {
                return $this->belongsTo('App\Model\Product')->withTrashed();
        }
}

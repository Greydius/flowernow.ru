<?php

namespace App\Model;

use App\MainModel;

class Agent extends MainModel
{
        //

        // relation for shop
        function shop() {
                return $this->belongsTo('App\Model\Shop');
        }

        // relation for city
        function city() {
                return $this->belongsTo('App\Model\City');
        }
}

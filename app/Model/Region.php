<?php

namespace App\Model;

use App\MainModel;

class Region extends MainModel
{
        // relation for cities
        function cities() {
                return $this->hasMany('App\Model\City');
        }
}

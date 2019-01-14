<?php

namespace App\Model;

use App\MainModel;

class PromoText extends MainModel
{
    //

        function flower() {
                return $this->belongsTo('App\Model\Flower');
        }
}

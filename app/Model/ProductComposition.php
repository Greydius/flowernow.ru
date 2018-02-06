<?php

namespace App\Model;

use App\MainModel;

class ProductComposition extends MainModel
{
    //
        protected $fillable = ['flower_id', 'qty'];

        function flower() {
                return $this->belongsTo('App\Model\Flower');
        }
}

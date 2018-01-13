<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductComposition extends Model
{
    //
        protected $fillable = ['flower_id', 'qty'];

        function flower() {
                return $this->belongsTo('App\Model\Flower');
        }
}

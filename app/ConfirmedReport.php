<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConfirmedReport extends Model
{
    // relation for shop
        function shop() {
                return $this->belongsTo('App\Model\Shop');
        }
}

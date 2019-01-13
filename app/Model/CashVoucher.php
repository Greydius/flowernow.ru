<?php

namespace App\Model;

use App\MainModel;

class CashVoucher extends MainModel
{
    //

        public function order() {
                return $this->belongsTo('App\Model\Order');
        }
}

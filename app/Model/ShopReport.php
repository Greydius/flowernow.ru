<?php

namespace App\Model;

use App\MainModel;

class ShopReport extends MainModel {
        //
        protected $dates = [
                'report_date',
        ];

        public function shop() {
                return $this->belongsTo('App\Model\Shop');
        }
}

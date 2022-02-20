<?php

namespace App\Model;

use App\MainModel;

class Report extends MainModel
{
        protected $dates = [
                'report_date',
        ];

        // relation for shop
        public function shop() {
                return $this->belongsTo('App\Model\Shop');
        }
}

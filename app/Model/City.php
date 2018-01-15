<?php

namespace App\Model;

use App\MainModel;

class City extends MainModel
{
    //
        protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

        public function region() {
                return $this->belongsTo('App\Model\Region');
        }
}

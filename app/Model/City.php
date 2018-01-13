<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    //
        protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

        public function region() {
                return $this->belongsTo('App\Model\Region');
        }
}

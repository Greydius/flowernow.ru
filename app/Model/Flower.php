<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Flower extends Model
{
    //
        protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
}

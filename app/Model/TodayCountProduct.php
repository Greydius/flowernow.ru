<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TodayCountProduct extends Model
{
    protected $fillable = array('city_id', 'count');
}

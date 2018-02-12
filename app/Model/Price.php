<?php

namespace App\Model;

use App\MainModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Price extends MainModel
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
}

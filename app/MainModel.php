<?php
/**
 * Created by PhpStorm.
 * User: Nick
 * Date: 19.12.2017
 * Time: 19:26
 */
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class MainModel extends Model {
        use SoftDeletes;
        protected $dates = ['deleted_at'];
}
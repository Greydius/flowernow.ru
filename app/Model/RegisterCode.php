<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RegisterCode extends Model
{
    //
        static function lastCode($phone) {
                return self::where('phone', $phone)->orderBy('created_at', 'desc')->first();
        }
}

<?php

namespace App\Model;

use App\MainModel;

class RegisterCode extends MainModel
{
    //
        static function lastCode($phone) {
                return self::where('phone', $phone)->orderBy('created_at', 'desc')->first();
        }
}

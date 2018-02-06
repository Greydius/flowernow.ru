<?php

namespace App\Helpers;
use Carbon\Carbon;

/**
 * Created by PhpStorm.
 * User: Nick
 * Date: 04.01.2018
 * Time: 17:43
 */
class AppHelper {

        public static function normalizePhone($phone) {
                $normalizedPhone = $phone;
                $normalizedPhone = str_replace('(', '', $normalizedPhone);
                $normalizedPhone = str_replace(')', '', $normalizedPhone);
                $normalizedPhone = str_replace('-', '', $normalizedPhone);

                return $normalizedPhone;
        }

        public static function diffInMinutes($date) {
                $last = Carbon::parse($date);
                $now = Carbon::now();
                return $last->diffInMinutes($now);
        }

        public static function getCode() {
                return rand(1000, 9999);
        }
}
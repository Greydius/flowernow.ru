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

        public static function formatTimeToMinutes($time) {
                if(!empty($time)) {
                        $times = explode(':', $time);
                        if(count($times) == 2) {
                                return (int)$times[0]*60 + (int)$times[1];
                        }
                }

                return 0;
        }
}
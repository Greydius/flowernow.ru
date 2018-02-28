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

        public static function urlShortener($longUrl) {
                $postData = ['longUrl' => $longUrl];
                $jsonData = json_encode($postData);

                //4
                $curlObj = curl_init();
                curl_setopt($curlObj, CURLOPT_URL, 'https://www.googleapis.com/urlshortener/v1/url?key='.\Config::get('app.google_app_key'));
                curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($curlObj, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($curlObj, CURLOPT_HEADER, 0);
                curl_setopt($curlObj, CURLOPT_HTTPHEADER, ['Content-type:application/json']);
                curl_setopt($curlObj, CURLOPT_POST, 1);
                curl_setopt($curlObj, CURLOPT_POSTFIELDS, $jsonData);

                //5
                $response = curl_exec($curlObj);

                $json = json_decode($response);
                //6
                curl_close($curlObj);

                //7
                return $json;
                if (isset($json->error)) {
                        echo $json->error->message;
                } else {
                        echo $json->id;
                }
        }
}
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
                $code[] = rand(0, 9);
                $code[] = rand(0, 9);
                $code[] = $code[0];
                $code[] = rand(0, 9);
                return implode("", $code);
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

        public static function formatMinutesToTime($time) {

                $_time = strtotime('2018-01-01 00:00:00') + ($time*60);

                return date('H:i', $_time);
        }

        public static function urlShortener_old($longUrl) {
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

        public static function urlShortener($longUrl) {
                $postData = ['url' => $longUrl];
                $jsonData = json_encode($postData);

                //4
                $curlObj = curl_init();
                curl_setopt($curlObj, CURLOPT_URL, 'https://clck.ru/--');
                curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($curlObj, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($curlObj, CURLOPT_HEADER, 0);
                //curl_setopt($curlObj, CURLOPT_HTTPHEADER, ['Content-type:application/json']);
                curl_setopt($curlObj, CURLOPT_POST, 1);
                curl_setopt($curlObj, CURLOPT_POSTFIELDS, http_build_query($postData));

                //5
                $response = curl_exec($curlObj);

                $json = json_decode($response);
                //6
                curl_close($curlObj);

                //7
                $return = new \stdClass();
                $return->id = $response;
                return $return;

                if (isset($json->error)) {
                        echo $json->error->message;
                } else {
                        echo $json->id;
                }
        }

        public static function cleantel($tel) {
                $tel = str_replace(" ", "", $tel);
                $tel = str_replace("+", "", $tel);
                $tel = str_replace("(", "", $tel);
                $tel = str_replace(")", "", $tel);
                $tel = str_replace("-", "", $tel);
                $tel = str_replace(" ", "", $tel);
                $tel = preg_replace("#^8#", "7", $tel);
                //$tel = $tel * 1;
                $tel = (int)$tel;
                return $tel;
        }

        public static function ruMonth($m, $case = '1') {
                $arr[1] = array(
                        1 => "января",
                        2 => "февраля",
                        3 => "марта",
                        4 => "апреля",
                        5 => "мая",
                        6 => "июня",
                        7 => "июля",
                        8 => "августа",
                        9 => "сентября",
                        10 => "октября",
                        11 => "ноября",
                        12 => "декабря"
                );

                $arr[2] = array(
                        1 => "январь",
                        2 => "февраль",
                        3 => "март",
                        4 => "апрель",
                        5 => "май",
                        6 => "июнь",
                        7 => "июль",
                        8 => "август",
                        9 => "сентябрь",
                        10 => "октябрь",
                        11 => "ноябрь",
                        12 => "декабрь"
                );

                return $arr[$case][(int)$m];
        }

        public static function num2str($num, $skobki = false) {
                $nul = 'ноль';
                $ten = array(
                        array('', 'один', 'два', 'три', 'четыре', 'пять', 'шесть', 'семь', 'восемь', 'девять'),
                        array('', 'одна', 'две', 'три', 'четыре', 'пять', 'шесть', 'семь', 'восемь', 'девять'),
                );
                $a20 = array('десять', 'одиннадцать', 'двенадцать', 'тринадцать', 'четырнадцать', 'пятнадцать', 'шестнадцать', 'семнадцать', 'восемнадцать', 'девятнадцать');
                $tens = array(2 => 'двадцать', 'тридцать', 'сорок', 'пятьдесят', 'шестьдесят', 'семьдесят', 'восемьдесят', 'девяносто');
                $hundred = array('', 'сто', 'двести', 'триста', 'четыреста', 'пятьсот', 'шестьсот', 'семьсот', 'восемьсот', 'девятьсот');
                $unit = array( // Units
                        array('копейка', 'копейки', 'копеек', 1),
                        array('рубль', 'рубля', 'рублей', 0),
                        array('тысяча', 'тысячи', 'тысяч', 1),
                        array('миллион', 'миллиона', 'миллионов', 0),
                        array('миллиард', 'милиарда', 'миллиардов', 0),
                );
                //
                list($rub, $kop) = explode('.', sprintf("%015.2f", floatval($num)));
                $out = array();
                if(intval($rub) > 0) {
                        foreach (str_split($rub, 3) as $uk => $v) { // by 3 symbols
                                if(!intval($v)) continue;
                                $uk = sizeof($unit) - $uk - 1; // unit key
                                $gender = $unit[$uk][3];
                                list($i1, $i2, $i3) = array_map('intval', str_split($v, 1));
                                // mega-logic
                                $out[] = $hundred[$i1]; # 1xx-9xx
                                if($i2 > 1) $out[] = $tens[$i2] . ' ' . $ten[$gender][$i3]; # 20-99
                                else $out[] = $i2 > 0 ? $a20[$i3] : $ten[$gender][$i3]; # 10-19 | 1-9
                                // units without rub & kop
                                if($uk > 1) $out[] = self::morph($v, $unit[$uk][0], $unit[$uk][1], $unit[$uk][2]);
                        } //foreach
                } else $out[] = $nul;

                if($skobki && count($out)) {
                        foreach($out as &$_out) {
                                if(!empty($_out)) {
                                        $_out = '('.$_out;
                                        break;
                                }
                        }
                        $out[count($out)-1] = $out[count($out)-1].')';
                }

                $out[] = self::morph(intval($rub), $unit[1][0], $unit[1][1], $unit[1][2]); // rub
                $out[] = $kop . ' ' . self::morph($kop, $unit[0][0], $unit[0][1], $unit[0][2]); // kop
                return trim(preg_replace('/ {2,}/', ' ', join(' ', $out)));
        }
        
        public static function morph($n, $f1, $f2, $f5) {
                $n = abs($n) % 100;
                $n1 = $n % 10;
                if($n > 10 && $n < 20) return $f5;
                if($n1 > 1 && $n1 < 5) return $f2;
                if($n1 == 1) return $f1;
                return $f5;
        }

        public static function orderTimeToArray($str) {
                $str = str_replace('с', '', $str);
                $str = str_replace('до ', '', $str);
                $str = trim($str);
                return explode(' ', $str);
        }

}
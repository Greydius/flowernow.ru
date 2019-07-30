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

        static function  RESIZER($src_img, $width, $height, $mode=0, $format=NULL, $quality=90) {

                if (empty($src_img) OR !file_exists(public_path() . $src_img)){
                        if (empty($width)) $width = $height;
                        if (empty($height)) $height = $width;
                        return "http://placehold.it/".(int)$width."x".(int)$height;
                }

                $path_parts = pathinfo($src_img);

                $img_size = @getimagesize(public_path() . $src_img);
                if ($img_size === false) return false;

                if (!$height){
                        $yy_ratio = $width / $img_size[0];
                        $height = floor($yy_ratio * $img_size[1]);
                }

                if (!$width){
                        $xx_ratio = $height / $img_size[1];
                        $width = floor($xx_ratio * $img_size[0]);
                }

                $SAVE_PATH = $path_parts['dirname'] . "/".$width."x".$height."_".($mode ? 'c' : 'r')."/";

                $FileName = $path_parts['basename']; // file name


                if (!is_dir(public_path() . $SAVE_PATH)){
                        mkdir(public_path() . $SAVE_PATH, 0755, 1);
                }

                $dest_img = public_path() . $SAVE_PATH.$FileName;


                if (file_exists($dest_img) && filemtime(public_path() . $src_img) < filemtime($dest_img))
                        return $SAVE_PATH.$FileName;

                $img_format = strtolower(substr($img_size['mime'], strpos($img_size['mime'], '/') + 1));
                if (($img_format == 'x-ms-bmp') || ($img_format == 'bitmap')) {
                        $img_format = 'bmp';
                }
                if (!function_exists($fn_imgcreatefrom = 'imagecreatefrom'.$img_format))
                        return false;

                if (!$format) {
                        $format = $img_format;
                }

                $x_ratio = $width / $img_size[0];
                $y_ratio = $height / $img_size[1];
                $new_x = 0;
                $new_y = 0;
                $old_width = $img_size[0];
                $old_height = $img_size[1];

                // just resize to this resolution
                if ($mode == 0) {
                        if ($x_ratio < $y_ratio) {
                                $new_width = $width;
                                $new_height = floor($x_ratio * $img_size[1]);
                        } else {
                                $new_height = $height;
                                $new_width = floor($y_ratio * $img_size[0]);
                        }
                }
                // proportionality
                elseif ($mode == 1) {
                        $new_height = $height;
                        $new_width = $width;
                        $new_x_ratio = $old_width / $new_width;
                        $new_y_ratio = $old_height / $new_height;
                        if ($new_x_ratio < $new_y_ratio) {
                                $old_height = floor($new_x_ratio * $new_height);
                                $new_y = floor(($img_size[1] - $old_height) / 2);
                        } elseif ($new_x_ratio > $new_y_ratio) {
                                $old_width = floor($new_y_ratio * $new_width);
                                $new_x = floor(($img_size[0] - $old_width) / 2);
                        }
                }
                // priorities
                else {
                        $new_height = $height;
                        $new_width = $width;
                        $new_x_ratio = $old_width / $new_width;
                        $new_y_ratio = $old_height / $new_height;
                        // width priority
                        if ($mode == 2) {
                                $old_height = floor($new_x_ratio * $new_height);
                                $new_y = floor(($img_size[1] - $old_height) / 2);
                        }
                        // height priority
                        elseif ($mode == 3) {
                                $old_width = floor($new_y_ratio * $new_width);
                                $new_x = floor(($img_size[0] - $old_width) / 2);
                        }
                }

                $gd_dest_img = imagecreatetruecolor($new_width, $new_height);
                $gd_src_img = $fn_imgcreatefrom(public_path() . $src_img);

                if (($format == 'png') || ($format == 'gif')) {
                        //self::setTransparency($gd_dest_img, $gd_src_img);
                        /*PNG FIX 17.06.2012*/
                        imagealphablending($gd_dest_img, false);
                        imagesavealpha($gd_dest_img, true);
                        $transparent = imagecolorallocatealpha($gd_dest_img, 255, 255, 255, 127);
                        imagefilledrectangle($gd_dest_img, 0, 0, $new_width, $new_height, $transparent);
                        /*PNG FIX END*/
                }

                imagecopyresampled($gd_dest_img, $gd_src_img, 0, 0, $new_x, $new_y, $new_width, $new_height, $old_width, $old_height);
                switch ($format) {
                        case 'gif': imagegif($gd_dest_img, $dest_img);
                                break;
                        case 'png': imagepng($gd_dest_img, $dest_img);
                                break;
                        case 'bmp': imagebmp($gd_dest_img, $dest_img);
                                break;
                        default: imagejpeg($gd_dest_img, $dest_img, $quality);
                                break;
                }
                imagedestroy($gd_dest_img);
                imagedestroy($gd_src_img);


                return $SAVE_PATH.$FileName;
        }

}
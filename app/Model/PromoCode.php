<?php

namespace App\Model;

use App\MainModel;

class PromoCode extends MainModel
{
    //
        protected $appends = ['text'];

        public static $rules = [
                'value' => 'required | integer',
                'code_type' => 'required | in:percent,sum'
        ];

        public  static $rulesMessages = [
                'value.required' => 'Укажите значение скидки',
                'value.integer' => 'Неверное значение скидки',
                'code_type.required' => 'Укажите тип скидки',
                'code_type.in' => 'Неверный тип',
        ];

        private static function generateCode($length) {
                //$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $characters = '0123456789ABCDEFGHIJKLMNPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                        $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
                return $randomString;
        }

        static function getNewCode() {
                $code_exist = true;

                while($code_exist) {
                        $code = self::generateCode(5);
                        $code_exist = (boolean)self::where('code', $code)->count();
                }

                return $code;

        }

        public function getTextAttribute() {
                return $this->value.($this->code_type == 'percent' ? '%' : '₽');
        }

}

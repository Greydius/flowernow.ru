<?php

namespace App\Model;



use App\MainModel;

class Shop extends MainModel
{
    //
        protected $hidden = ['email', 'phone', 'phone_confirmed', 'email_confirmed', 'created_at', 'updated_at', 'deleted_at'];

        public static $logoRules = [
                'file' => 'required | mimes:jpeg,jpg,png,PNG,JPEG,JPG | max:10000',
        ];

        public  static $logoRulesMessages = [
                'file.required' => 'Выберите файл',
                'file.mimes' => 'Неверный формат файла. Требуется *.jpg *.jpeg *.png',
                'file.max' => 'Файл не должен больше 10Мб',
        ];

        public static $fileUrl = '/uploads/shops/';

        public function __construct(array $attributes = []) {
                parent::__construct($attributes);
        }


        // relation for users
        function users() {
                return $this->belongsToMany('App\User');
        }

        // relation for users
        function city() {
                return $this->belongsTo('App\Model\City');
        }

        // relation for products
        function products() {
                return $this->hasMany('App\Model\Product');
        }

        // relation for orders
        function orders() {
                return $this->hasMany('App\Model\Order');
        }

        // relation for address
        function address() {
                return $this->hasMany('App\Model\ShopAddress');
        }
}

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

        // relation for work time
        function workTime() {
                return $this->hasMany('App\Model\ShopWorkTime')->orderBy('day');
        }

        // relation for work time
        function workers() {
                return $this->hasMany('App\Model\ShopWorker');
        }
        
        public function getDeliveryTimeFormatAttribute() {

                $return = '';

                if($this->delivery_time) {
                        $hours = floor($this->delivery_time / 60);
                        $minutes = $this->delivery_time % 60;

                        $return .= ($hours ? $hours : '00').':';
                        $return .= ($minutes ? $minutes : '00');
                }

                return $return;
        }

        public function getContactPhones() {
                $phones = [];

                if(!empty($this->phone)) {
                        $phones[] = $this->phone;
                }

                foreach ($this->workers()->where('position_id', 2)->get() as $worker) {
                        if(!empty($worker->phone)) {
                                $phones[] = $this->phone;
                        }
                }

                foreach ($this->workers()->where('position_id', 1)->get() as $worker) {
                        if(!empty($worker->phone)) {
                                $phones[] = $this->phone;
                        }
                }

                return $phones;
        }
}

<?php

namespace App\Model;

use App\MainModel;
use App\Model\OrderList;
use \App\Helpers\Sms;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends MainModel
{
        use SoftDeletes;

        protected $dates = ['deleted_at'];

        protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

        protected $appends = ['amount', 'amountShop'];

        public static function boot() {
                parent::boot();

                self::creating(function ($model) {
                        // ... code here
                        $key = str_random(16);
                        $model->key = $key;
                });

                self::created(function ($model) {
                        // ... code here
                });

                self::updating(function ($model) {
                        // ... code here
                });

                self::updated(function ($model) {
                        // ... code here
                });

                self::deleting(function ($model) {
                        // ... code here
                });

                self::deleted(function ($model) {
                        // ... code here
                });
        }

    //
        public static $orderRules = [
                'receiving_date' => 'required | date_format:"d.m.Y"',
                'receiving_time' => 'required',
                'phone' => 'required',
        ];

        public  static $orderRulesMessages = [
                'receiving_date.required' => 'Выберите дату',
                'receiving_date.date_format' => 'Неверный формат даты',
                'receiving_time.required' => 'Выберите время доставки',
                'phone.required' => 'Введите номер телефона'
        ];

        public static $STATUS_NEW = 'new';
        public static $STATUS_ACCEPTED = 'accepted';
        public static $STATUS_COMPLETED = 'completed';

        public static $PAYMENT_CARD = 'card';
        public static $PAYMENT_RS = 'rs';
        public static $PAYMENT_CASH = 'cash';

        // relation for Order List
        function orderLists() {
                return $this->hasMany('App\Model\OrderList');
        }

        // relation for shop
        function shop() {
                return $this->belongsTo('App\Model\Shop');
        }

        //возвращает сумму заказа
        public function amount() {
                $amount = 0;
                foreach ($this->orderLists()->get() as $orderList) {
                        $amount += $orderList->client_price;
                }

                return $amount + $this->delivery_out_distance * (!empty($this->delivery_out_price) ? $this->delivery_out_price : 0);
        }

        public function getAmountAttribute() {
                return $this->amount();
        }

        //возвращает сумму заказа
        public function amountShop() {
                $amount = 0;
                foreach ($this->orderLists()->get() as $orderList) {
                        $amount += $orderList->shop_price;
                }

                return $amount + $this->delivery_price + $this->delivery_out_distance * (!empty($this->delivery_out_price) ? $this->delivery_out_price : 0);
        }

        public function getAmountShopAttribute() {
                return $this->amountShop();
        }

        public function getStatusNameAttribute() {
                $name = '';

                switch ($this->status) {
                        case Order::$STATUS_NEW:
                                $name = 'новый';
                                break;

                        case Order::$STATUS_ACCEPTED:
                                $name = 'принят';
                                break;

                        case Order::$STATUS_COMPLETED:
                                $name = 'выполнен';
                                break;
                }

                return $name;
        }

        public function getDetailsLink() {
                return route('order.details', ['key' => $this->key]);
        }
        
        public function changeStatusNotification() {
                try {
                        if($this->status ==  Order::$STATUS_ACCEPTED) {
                                if(!empty($this->phone)) {
                                        Sms::instance()->send($this->phone, "Ваш заказ в работе, тел. исполнителя: +".$this->shop->phone);
                                }
                        }
                }  catch(\Exception $e){

                }
        }
}

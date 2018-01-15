<?php

namespace App\Model;

use App\MainModel;
use App\Model\OrderList;

class Order extends MainModel
{
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

                return $amount;
        }

        //возвращает сумму заказа
        public function amountShop() {
                $amount = 0;
                foreach ($this->orderLists()->get() as $orderList) {
                        $amount += $orderList->shop_price;
                }

                return $amount;
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
}

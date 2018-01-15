<?php

namespace App\Model;

use App\MainModel;

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
}

<?php

namespace App\Model;



use App\MainModel;
use App\Model\Transaction;

class Shop extends MainModel
{
    //
        protected $fillable = ['balance'];
        //protected $appends = ['frozenBalance'];
        protected $hidden = ['email', 'phone', 'phone_confirmed', 'email_confirmed',
                'created_at', 'updated_at', 'deleted_at', 'org_name', 'rs', 'bank',
                'bik', 'ks', 'inn', 'kpp', 'ogrn', 'org_address', 'director', 'osnovanie', 'balance'];

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

        // relation for Invoice
        function invoices() {
                return $this->hasMany('App\Model\Invoice');
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

        public function getDeliveryTimeFormat2Attribute() {

                $return = '';

                if($this->delivery_time) {
                        $hours = floor($this->delivery_time / 60);
                        $minutes = $this->delivery_time % 60;

                        $return .= ($hours ? $hours.'ч ' : '');
                        $return .= ($minutes ? $minutes.'мин' : '');
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

        public function frozenBalance() {
                $amount = Transaction::where('id', '>', 103)->where('shop_id', $this->id)->where('action', 'order')->where('amount', '>', 0)->where('created_at', '>=', date('Y-m-d H:i:s', time()-(60*60*24*3) ))->sum('amount');

                return $amount;
        }

        public function getFrozenBalanceAttribute() {
                return $this->frozenBalance();
        }

        public function availableOutBalance() {

                $outBalance = $this->balance - $this->frozenBalance();
                return ($outBalance >= 0 ? $outBalance : 0);
        }

        public function getAvailableOutBalanceAttribute() {
                return $this->availableOutBalance();
        }

        //conditions for product
        public static function scopeAvailable($query) {
                return $query->where('active', 1)->where(function ($query) {
                        $query->where('delivery_price', '>', 0)
                                ->orWhere('delivery_free', '=', 1);
                });
        }

        public function workTimeIsSet() {
                $isSet = false;
                $workTime = $this->workTime;

                if(!empty($workTime)) {
                        foreach ($workTime as $item) {
                                if($item->is_work) {
                                        $isSet = true;
                                }
                        }
                }

                return $isSet;
        }
}

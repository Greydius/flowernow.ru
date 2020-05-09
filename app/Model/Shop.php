<?php

namespace App\Model;



use App\MainModel;
use App\Model\Transaction;
use App\Helpers\AppHelper;

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

        // relation for orders
        function confirmedReports() {
                return $this->hasMany('App\ConfirmedReport');
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

        // relation for feedbacks
        function feedbacks() {
                return $this->hasMany('App\Model\Feedback');
        }

        // relation for reports
        function reports() {
                return $this->hasMany('App\Model\ShopReport');
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

        public function getSmsPhones() {
                $phones = [];

                if(!empty($this->phone)) {
                        $phones[$this->phone] = $this->phone;
                }

                foreach ($this->workers()->where('notify', 1)->get() as $worker) {
                        if(!empty($worker->phone)) {
                                $phone = AppHelper::normalizePhone($worker->phone);
                                $phones[$phone] = $phone;
                        }
                }

                return $phones;
        }

        public function frozenBalance() {
                $amount = Transaction::where('id', '>', 103)
                        ->where('shop_id', $this->id)
                        ->where('action', 'order')
                        ->where('amount', '>', 0)
                        ->where('created_at', '>=', date('Y-m-d H:i:s', time()-(60*60*24*3) ))
                        ->sum('amount');

                return $amount;
        }

        public function getFrozenBalanceAttribute() {
                return $this->frozenBalance();
        }

        public function availableOutBalance() {
          $shop = $this;
          $toDate = !empty($request->toDate) ? \Carbon\Carbon::parse($request->toDate) : \Carbon\Carbon::now();
                $threeDay = 60*60*24*3;
                $threeDayDate = $toDate->subDays(3);

                $orderIds = Transaction::where('id', '>', 103)->where('shop_id', $shop->id)->where('action', 'order')->where('amount', '>', 0)->where('created_at', '>=', date('Y-m-d H:i:s', time()-(60*60*24*3) ))->pluck('action_id')->toArray();

                        if(empty($orderIds)) {
                                $orderIds[] = 0;
                        }
                        $lastOutputTransaction = Transaction::where('shop_id', $shop->id)->where('action', 'out')->where('created_at', '<', $toDate->toDateTimeString())->orderBy('created_at', 'DESC')->first();
                        $dateFrom = !empty($lastOutputTransaction) ? \Carbon\Carbon::parse($lastOutputTransaction->created_at) : \Carbon\Carbon::parse('2010-10-10 00:00:00');

                        $availableOrderIds = Transaction::where('shop_id', $shop->id)->where('action', 'order')->where('amount', '>', 0)->where('created_at', '>', $dateFrom->format('Y-m-d H:i:s'))->pluck('action_id')->toArray();

                        $ordersA = Order::where('shop_id', $shop->id)->where('status', 'completed')->whereIn('id', $availableOrderIds)->get();

                        $ordersASum = 0;
                        foreach($ordersA as $orderA) {
                          $ordersASum += $orderA->amountShop();
                        }
                        //print_r($orders); exit();

                $outBalance = $ordersASum;
                return round(($outBalance >= 0 ? $outBalance : 0));
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

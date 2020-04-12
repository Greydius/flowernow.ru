<?php

namespace App\Model;

use App\MainModel;
use App\Model\OrderList;
use App\Model\Transaction;
use App\Model\Shop;
use App\User;
use \App\Helpers\Sms;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Helpers\AppHelper;

class Order extends MainModel
{
        use SoftDeletes;

        protected $dates = ['deleted_at'];

        protected $hidden = ['created_at', 'updated_at', 'deleted_at', 'sms_code', 'sms_send_at'];

        protected $appends = ['amount', 'amountShop', 'receivingDateFormat', 'payedDateFormat', 'createdAtFormat'];

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

        // relation for promo
        function promo() {
                return $this->belongsTo('App\Model\PromoCode', 'promo_code_id');
        }

        // relation for cash vouchers
        function cashVouchers() {
                return $this->hasMany('App\Model\CashVoucher');
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

        public function getAmountFAttribute() {
                return number_format($this->amount(), 2, '.', ' ');
        }

        //возвращает сумму заказа
        public function amountShop() {
                $date = \Carbon::create(2020, 4, 12, 13, 00, 00);

                if(\Carbon::parse($this->created_at)->greaterThanOrEqualTo($date)){
                  $amount = 0;
                  $commission = $this->commission == null ? 25 : $this->commission;
                  
                  foreach ($this->orderLists()->get() as $orderList) {
                          $amount += ($orderList->shop_price * $orderList->qty);
                  }

                  $delivery_amount = $this->delivery_price + $this->delivery_out_distance * (!empty($this->delivery_out_price) ? $this->delivery_out_price : 0);
                  $delivery_amount_with_commission = $delivery_amount * (1-($commission/100));

                  $amount_with_commission = $amount * (1-($commission/100));

                  if($this->report_price != null && $this->report_price != 0){
                    if($this->report_shop_price != null && $this->report_shop_price != 0){
                      return $this->report_shop_price;
                    }else if($this->payment == Order::$PAYMENT_CASH) {
                      return (-1)*($this->report_price - ($this->report_price * (1-($commission/100))));
                    }else {
                      return $this->report_price * (1-($commission/100));
                    }
                    
                  } else {
                    if($this->payment == Order::$PAYMENT_CASH) {
                            return (-1)*($this->amount() - ($amount_with_commission + $delivery_amount_with_commission));
                    }
                    
                    return $amount_with_commission + $delivery_amount_with_commission;
                  }  
                } else {
                  if($this->report_price != null && $this->report_price != 0){
                    if($this->report_shop_price != null && $this->report_shop_price != 0){
                      return $this->report_shop_price;
                    }else if($this->payment == Order::$PAYMENT_CASH) {
                      return (-1)*($this->report_price - ($this->report_price * (1-($commission/100))));
                    }else {
                      return $this->report_price * (1-($commission/100));
                    }
                    
                  } else {
                    $amount = 0;
                    foreach ($this->orderLists()->get() as $orderList) {
                            $amount += ($orderList->shop_price * $orderList->qty);
                    }

                    if($this->payment == Order::$PAYMENT_CASH) {
                            return (-1)*($this->amount() - $amount - ($this->delivery_price + $this->delivery_out_distance * (!empty($this->delivery_out_price) ? $this->delivery_out_price : 0)));
                    }

                    return $amount + $this->delivery_price + $this->delivery_out_distance * (!empty($this->delivery_out_price) ? $this->delivery_out_price : 0);
                  } 
                  
                }
                
                
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

                $href = route('order.details', [
                        'key' => $this->key
                ], false);

                $shop = $this->shop;

                $href = !empty($shop->city->slug) && $shop->city->slug != 'moskva' ? 'https://'.$shop->city->slug.'.floristum.ru'.$href : 'https://floristum.ru'.$href;
                
                //return route('order.details', ['key' => $this->key]);
                return $href;
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

        public function createTransaction() {

                if(!Transaction::where('action', 'order')->where('action_id', $this->id)->count()) {

                        \DB::beginTransaction();

                        try{
                                $transaction = new Transaction();
                                $transaction->shop_id = $this->shop_id;
                                $transaction->action = 'order';
                                $transaction->action_id = $this->id;
                                $transaction->amount = $this->amountShop();
                                if($this->payment == Order::$PAYMENT_CASH) {
                                        $transaction->subtract = (-1)*$transaction->amount;
                                } else {
                                        $transaction->subtract = $this->amount() - $transaction->amount;
                                }

                                if($transaction->save()) {
                                        $shop = Shop::find($this->shop_id);
                                        $shop->balance = $shop->balance + $transaction->amount;
                                        if($shop->save()) {
                                                \DB::commit();
                                        }

                                        return $transaction->id;
                                }

                                \DB::rollBack();

                        } catch (\Exception $e) {

                                \DB::rollBack();

                                throw $e;
                        }

                }

                return null;
        }

        private function invoiceFileName() {
                return 'invoice_' . $this->id . '.pdf';
        }

        private function invoiceFilePath() {
                return '/invoices/' . $this->invoiceFileName();
        }

        public function generateInvoice() {
                try {
                        $dompdf = new Dompdf();
                        $dompdf->set_option('isRemoteEnabled', true);
                        $dompdf->set_option('isHtml5ParserEnabled', true);

                        $date = date('d') . ' ' . \App\Helpers\AppHelper::ruMonth(date('m')) . ' ' . date('Y') . ' г.';

                        $view = view('invoices.invoice', [
                                'header' => 'Счет на оплату № ' . $this->id . ' от ' . $date,
                                'order' => $this
                        ])->render();

                        $dompdf->loadHtml($view, 'UTF-8');

                        // Render the HTML as PDF
                        $dompdf->render();
                        \Storage::disk('local')->put($this->invoiceFilePath(), $dompdf->output());
                }  catch(\Exception $e){
                        \Log::error($e);
                }
        }

        public function getInvoicePathAttribute() {
                $path = '';

                if($this->payment == Order::$PAYMENT_RS && \Storage::disk('local')->exists($this->invoiceFilePath())) {
                        $path = \Storage::disk('local')->getDriver()->getAdapter()->applyPathPrefix($this->invoiceFilePath());
                }

                return $path;
        }

        public function getReceivingDateFormatAttribute() {
                $receivingDate = $this->receiving_date;

                if(!empty($receivingDate)) {
                        $receivingTime = strtotime($receivingDate);
                        $receivingDate = date('d', $receivingTime).' '.AppHelper::ruMonth(date('m', $receivingTime)).' '.date('Y', $receivingTime);
                }

                return $receivingDate;
        }

        public function getPayedDateFormatAttribute() {
                $payedAt = $this->payed_at;

                if(!empty($payedAt)) {
                        $payedAtTime = strtotime($payedAt);
                        $payedAt = date('d', $payedAtTime).' '.AppHelper::ruMonth(date('m', $payedAtTime)).' '.date('Y H:i', $payedAtTime);
                }

                return $payedAt;
        }

        public function getCreatedAtFormatAttribute() {
                $createdAt = $this->created_at;

                if(!empty($createdAt)) {
                        $createdAtTime = strtotime($createdAt);
                        $createdAt = date('d', $createdAtTime).' '.AppHelper::ruMonth(date('m', $createdAtTime)).' '.date('Y H:i', $createdAtTime);
                }

                return $createdAt;
        }
        
        public function sendSms() {
                $code = AppHelper::getCode();
                Sms::instance()->send($this->phone, 'Код-подтверждение заказа: '.$code);
                return $code;
                //if(!empty($this->sms_send_at) && AppHelper::diffInMinutes($this->sms_send_at) < 1)
        }

        public function createSuccessCompletedMsg() {

                if(!empty($this->phone)) {

                        $link = route('feedback.add', ['key' => $this->key]);

                        try {
                                $shortLink = \App\Helpers\AppHelper::urlShortener($link)->id;
                        } catch (\Exception $e) {
                                $shortLink = $link;
                        }

                        $message = new Message();
                        $message->message_type = 'sms';
                        $message->send_to = $this->phone;
                        $message->msg = json_encode(['text' => 'Заказ №'.$this->id.' выполнен. Получите скидку до 30% за отзыв '.$shortLink]);
                        $message->save();
                }

                /*
                if(!empty($this->email)) {
                        $message->message_type = 'email';
                        $message->send_to = $this->email;
                        $message->msg = json_encode(['text' => view('email.clientCompletedOrder', [
                                'order' => $this
                        ])->render(),
                                'subject' => 'Заказ №'.$this->id.' выполнен']);
                        $message->save();
                } elseif(!empty($this->phone)) {
                        $message->message_type = 'sms';
                        $message->send_to = $this->phone;
                        $message->msg = json_encode(['text' => 'Заказ №'.$this->id.' выполнен']);
                        $message->save();
                }
                */
        }

        public static function ordersSumForPeriod($dateFrom, $dateTo) {
                return Order::where('orders.created_at', '>=', $dateFrom)
                        ->where('orders.created_at', '<=', $dateTo)
                        ->where('payed', 1)
                        ->join('order_lists', 'orders.id', '=', 'order_lists.order_id')
                        ->sum(\DB::raw('order_lists.shop_price+orders.delivery_price'));
        }

        public static function ordersCountForPeriod($dateFrom, $dateTo) {
                return Order::where('orders.created_at', '>=', $dateFrom)
                        ->where('orders.created_at', '<=', $dateTo)
                        ->where('orders.payed', 1)
                        ->count();
        }

        public static function avgOrderPrice($dateFrom, $dateTo) {
                $ordersSum = Order::ordersSumForPeriod($dateFrom, $dateTo);

                $ordersCount = Order::ordersCountForPeriod($dateFrom, $dateTo);

                if($ordersCount) {
                        return round($ordersSum/$ordersCount);
                }
                
                return 0;
        }

        public static function avgPayedOrders($dateFrom, $dateTo) {
                $ordersCount = Order::ordersCountForPeriod($dateFrom, $dateTo);

                $days = $dateFrom->diff($dateTo)->days;

                $days = $days ? $days : 1;

                if($days) {
                        return round($ordersCount/$days);
                }

                return 0;
        }

        public function rejection() {

                $this->city_id = $this->shop->city_id;
                $this->prev_shop_id = $this->shop_id;
                $this->shop_id = -1;
                $this->save();

                $this->sendNotification();

                return true;
        }

        function sendNotification() {

                $cityId = $this->city_id;
                $currentShopId = $this->prev_shop_id;

                $users = User::whereHas('shops', function ($query) use ($cityId, $currentShopId) {
                        $query->where('city_id', $cityId)->where('id', '!=', $currentShopId);
                })->whereNotNull('firebase_token')->get();

                if(!empty($users)) {
                        foreach($users as $user) {
                                $this->sendPushNotification($user->firebase_token,
                                        [
                                                'title' => 'Свободный заказ',
                                                'body' => 'Появился новый свободный заказ №'.$this->id,
                                        ]
                                );
                        }
                }
        }

        function sendPushNotification($to = '', $data = []) {
                $apiKey = 'AAAAS3WGJYU:APA91bEiqtnQ853Yb6VdbZem_Ygr9QlhMw1lZMP6iqCN-1HvT0MNKyEn8tcGtvijg03oCScEkhSyX6LEPidUdUyc6y17QuZkDX6DFIkEPhyD0LENwKkxhfv9qSZRlajL8EpOAS5vWUn6';
                $fields = [
                        'to' => $to,
                        'notification' => $data
                ];

                $headers = [
                        'Authorization: key='.$apiKey,
                        'Content-type: Application/json'
                ];

                $url = 'https://fcm.googleapis.com/fcm/send';

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
                $result = curl_exec($ch);
                curl_close($ch);

                return json_decode($result);
        }
}

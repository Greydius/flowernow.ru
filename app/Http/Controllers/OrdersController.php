<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelper;
use App\Model\Product;
use App\Model\Order;
use App\Model\OrderCharge;
use App\User;
use App\Model\OrderList;
use App\Helpers\Sms;
use App\Model\Shop;
use App\Model\PromoCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class OrdersController extends Controller
{
    //

        function add($productId, Request $request) {

                $product = Product::with('shop.city')->with('compositions.flower')->with('singleProduct.parent')->findOrFail($productId);

                $params = [
                        'product' => $product,
                        'qty' => 1,
                        'pageTitle' => 'Оплата доставки '.$product->name.' в г '.$product->shop->city->name,
                        'pageDescription' => 'Оплата доставки '.$product->name.' в г '.$product->shop->city->name.' и оформление заказа',
                        'pageKeywords' => $product->name.', букет, цветы, доставка, заказ, '.$product->shop->city->name.', оплата',
                ];

                if(!empty($product->single)) {
                        $qty = !empty($request->qty) ? $request->qty : $product->singleProduct->qty_from;
                        $params['qty'] = $qty;
                }

                $params['dopProducts'] = Product::where('dop', 1)->where('shop_id', $product->shop_id)->get();

                return view('front.order.add',$params);
        }

        function create(Request $request) {
                $order = Input::all();

                $validator = Validator::make($order, Order::$orderRules, Order::$orderRulesMessages);

                if ($validator->fails()) {

                        return response()->json([
                                'error' => true,
                                'message' => $validator->messages()->first(),
                                'code' => 400
                        ], 400);
                } else {

                        try {
                                \DB::beginTransaction();

                                $products = $request->products;
                                $productModel = [];
                                $orderListCount = 0;

                                if(empty($products)) {
                                        return response()->json([
                                                'error' => true,
                                                'message' => 'Ошибка! Обратитесь в службу поддержки.',
                                                'code' => 400
                                        ], 400);
                                }

                                foreach ($products as $product_id) {
                                        $_product = Product::with('singleProduct')->find($product_id);
                                        if(!empty($_product->single)) {
                                                $_product->qty = !empty((int)$request->qty) ? (int)$request->qty : $_product->singleProduct->qty_from;
                                        }
                                        
                                        $productModel[] = $_product;
                                }

                                if(!empty($productModel)) {
                                        $shop_id = $productModel[0]->shop_id;
                                        if(!empty($request->promo_code)) {
                                                $productModel[0]->setPromoCode($request->promo_code);
                                        }
                                }

                                $shop = Shop::find($shop_id);

                                $date = \DateTime::createFromFormat('d.m.Y', $request->receiving_date);

                                $order = new Order();
                                $order->shop_id = $shop_id;
                                $order->recipient_name = $request->recipient_name;
                                $order->recipient_phone = $request->recipient_phone;
                                $order->recipient_address = $request->recipient_address;
                                $order->recipient_flat = $request->recipient_flat;
                                $order->recipient_self = !empty($request->recipient_self) ? 1 : 0;
                                $order->receiving_date = $date->format('Y-m-d');
                                $order->receiving_time = $request->receiving_time;
                                $order->anonymous = !empty($request->anonymous) ? 1 : 0;
                                $order->name = $request->name;
                                $order->phone = $request->phone;
                                $order->email = $request->email;
                                $order->text = $request->text;
                                $order->status = Order::$STATUS_NEW;
                                $order->payment = $request->payment == 'cash' ? Order::$PAYMENT_CASH : $request->payment == 'rs' ? Order::$PAYMENT_RS : Order::$PAYMENT_CARD;
                                $order->payed = $order->payment == Order::$PAYMENT_CASH ? 1 : 0;
                                $order->delivery_price = $shop->delivery_price;
                                $order->ur_name = $request->ur_name;
                                $order->ur_inn = $request->ur_inn;
                                $order->ur_kpp = $request->ur_kpp;
                                $order->ur_address = $request->ur_address;
                                $order->ur_bank = $request->ur_bank;
                                $order->ur_email = $request->ur_email;

                                if(!empty($request->delivery_out)) {
                                        $order->delivery_out_distance = (int)$request->delivery_out_distance;
                                        $order->delivery_out_price = $shop->delivery_out_price;
                                }

                                if($order->save()) {
                                        $order->fresh();

                                        $dopProducts = $request->dop_products;
                                        if(!empty($dopProducts)) {
                                                foreach ($dopProducts as $key => $value) {
                                                        $_product = Product::where('dop', 1)->find($key);
                                                        $_product->qty = $value;

                                                        $productModel[] = $_product;
                                                }
                                        }

                                        foreach ($productModel as $item) {
                                                $orderList = new OrderList();
                                                $orderList->order_id = $order->id;
                                                $orderList->product_id = $item->id;
                                                $orderList->single = empty($item->single) ? 0 : 1;
                                                $orderList->qty = $item->dop ? $item->qty : (!empty((int)$request->qty) ? (int)$request->qty : 1);
                                                $orderList->shop_price = $item->price;
                                                $orderList->client_price = $orderList->single ? $item->clientPrice : ($item->clientPrice * $orderList->qty);

                                                $orderListCount += (int)$orderList->save();

                                                if(!empty($item->promoCode)) {
                                                        $order->promo_code_id = $item->promoCode->id;
                                                        $order->save();

                                                        //$item->promoCode->used_on = \Carbon::now()->format('Y-m-d H:i:s');
                                                        //$item->promoCode->save();
                                                }
                                        }
                                }

                                if($orderListCount) {
                                        \DB::commit();


                                        try {
                                                if($order->payment == Order::$PAYMENT_RS) {
                                                        Mail::send('email.adminNewOrder', ['order' => $order, ], function ($message) use ($order) {
                                                                $message->to('service@floristum.ru')
                                                                        ->subject('Создан новый заказ для ЮР. ЛИЦА №'. $order->id);
                                                        });

                                                        //sms for admins
                                                        Sms::instance()->send('+79119245792', 'Поступил заказ для ЮР. ЛИЦА №'.$order->id  );
                                                        Sms::instance()->send('+79052122383', 'Поступил заказ для ЮР. ЛИЦА №'.$order->id  );
                                                } else {
                                                        Mail::send('email.adminNewOrder', ['order' => $order, ], function ($message) use ($order) {
                                                                $message->to('service@floristum.ru')
                                                                        ->subject('Создан новый заказ №'. $order->id);
                                                        });
                                                }
                                        } catch(\Exception $e){

                                        }

                                        $response = [
                                                'order_id' => $order->id,
                                                'message' => '',
                                                'code' => 200
                                        ];

                                        if($order->payment == Order::$PAYMENT_CARD) {
                                                $cloudpaymentsDetails = [
                                                        'publicId'      => \Config::get('cloudpayments.publicId'),  //id из личного кабинета
                                                        'description'   => 'Заказ №'.$order->id, //назначение
                                                        'amount'        => $order->amount(), //сумма
                                                        'currency'      => 'RUB', //валюта
                                                        'invoiceId'     => $order->id, //номер заказа  (необязательно)
                                                        'accountId'     => $order->email, //идентификатор плательщика (необязательно)
                                                        'data'          => [
                                                                'link' => $order->getDetailsLink()
                                                        ]
                                                ];

                                                $response['cloudpayments'] = $cloudpaymentsDetails;
                                        } elseif($order->payment == Order::$PAYMENT_RS) {
                                                $response['link'] = route('payment.success_ur', ['order_id' => $order->id]);
                                        }

                                        return response()->json($response, 200);

                                } else {
                                        \DB::rollback();
                                        return response()->json([
                                                'error' => true,
                                                'message' => 'Ошибка! Обратитесь в службу поддержки.',
                                                'code' => 400
                                        ], 400);
                                }

                        } catch(\Exception $e){
                                \DB::rollback();
                                // catch code
                                return response()->json([
                                        'error' => true,
                                        'message' => 'Ошибка! Обратитесь в службу поддержки.'.$e->getMessage(),
                                        'code' => 400
                                ], 400);
                        }

                }
        }

        function checkpayment(Request $request) {

                $code = 0;

                $order = Order::find($request->InvoiceId);

                if(empty($order)) {
                        $code = 10;
                } elseif ($order->amount() != $request->Amount) {
                        $code = 11;
                } elseif ($order->payed) {
                        $code = 13;
                }

                return response()->json([
                        'code' => $code
                ], 200);
        }

        function confirmpayment(Request $request) {
                $code = 0;

                $order = Order::with('shop')->find($request->InvoiceId);

                if(empty($order)) {
                        $code = 10;
                } else {
                        $order->payed = 1;
                        $order->payed_at = \Carbon::now()->format('Y-m-d H:i:s');
                        if($order->save()) {
                                if(!empty($order->promo_code_id)) {
                                        PromoCode::where('id', $order->promo_code_id)->update(['used_on' => \Carbon::now()->format('Y-m-d H:i:s')]);
                                }
                                $this->sendSuccessSms($order);
                                $this->sendSuccessEmails($order);
                        }
                }

                return response()->json([
                        'code' => $code
                ], 200);
        }

        private function sendSuccessSms($order) {
                try {
                        $shop = $order->shop;
                        if($shop->phone) {
                                $link = \Autologin::route($shop->users[0], 'admin.orders');
                                try {
                                        $shortLink = \App\Helpers\AppHelper::urlShortener($link)->id;
                                } catch (\Exception $e) {
                                        $shortLink = $link;
                                }
                                Sms::instance()->send($shop->phone, 'Примите заказ '.$order->id.' '.$shortLink  );

                                //sms for admins
                                Sms::instance()->send('+79119245792', 'Поступил заказ '.$order->id.' '.$shortLink  );
                                Sms::instance()->send('+79052122383', 'Поступил заказ '.$order->id.' '.$shortLink  );
                        }

                        if($order->phone) {
                                $txt = 'Ваш заказ '.$order->id.' оплачен! Отслеживание: ';
                                $standartOrderLink = $order->getDetailsLink();

                                try {
                                        $shortOrderLink = \App\Helpers\AppHelper::urlShortener($standartOrderLink)->id;
                                } catch (\Exception $e) {
                                        $shortOrderLink = $standartOrderLink;
                                }
                                //$txt .= $shortOrderLink;
                                $txt .= $standartOrderLink;

                                Sms::instance()->send($order->phone, $txt);
                        }

                } catch (\Exception $e) {

                }
        }

        private function sendSuccessEmails($order) {

                try {

                        $shop = $order->shop;

                        if(!empty($shop->email)) {

                                $link = \Autologin::route($shop->users[0], 'admin.orders');

                                Mail::send('email.shopNewOrder', ['link' => $link, ], function ($message) use ($order, $shop) {
                                        $message->to($shop->email)
                                                ->subject('Примите заказ на Floristum.ru №'. $order->id );
                                });
                        }

                        if(!empty($order->email)) {
                                Mail::send('email.clientNewOrder', ['order' => $order, ], function ($message) use ($order) {
                                        $message->to($order->email)
                                                ->subject('Заказ №'. $order->id .' оплачен!');
                                });
                        }



                } catch (\Exception $e) {

                }
        }

        function success($order_id = null) {

                if(empty($order_id)) {
                        return view('front.order.success',[]);
                } else {
                        return view('front.order.success-ur',[
                                'order' => Order::with('orderLists.product')->where('id', $order_id)->first()
                        ]);
                }
        }

        function orders() {

                $orders = $this->user->getShop()->orders()->with('orderLists.product')->where('payed', 1)->orderBy('receiving_date', 'asc')->orderBy('receiving_time', 'asc')->get();

                return view('admin.orders.list', [
                        'orders' => $orders
                ]);
        }

        public function apiList(Request $request) {

                $statusCode = 200;
                $response = [
                        'orders' => []
                ];

                try{
                        if($this->user->admin) {
                                $orderModel = Order::with('orderLists.product')
                                        ->with('shop.city.region')
                                        ->with('promo')
                                        //->orderBy('payed_at', 'desc')
                                        ->orderBy('created_at', 'desc')
                                        ->orderBy('receiving_date', 'asc')
                                        ->orderBy('receiving_time', 'asc');

                                if(!empty($request->dateFrom)) {
                                        $orderModel->where('created_at', '>=', \Carbon\Carbon::parse($request->dateFrom)->format('Y-m-d 00:00:00'));
                                        //echo \Carbon\Carbon::parse($request->dateFrom)->format('Y-m-d 00:00:00'); exit();
                                }

                                if(!empty($request->dateTo)) {
                                        $orderModel->where('created_at', '<=', \Carbon\Carbon::parse($request->dateTo)->format('Y-m-d 23:59:59'));
                                }

                                if(!empty($request->search)) {

                                        $orderModel->whereHas('shop', function($query) use ($request) {
                                                $query->where('shops.name', 'like', "%$request->search%");
                                        });
                                }

                                $orders = $orderModel->get()->toArray();
                                array_walk_recursive($orders, function(&$item){$item=strval($item);});
                        } else {
                                $orders = $this->user->getShop()->orders()->with('orderLists.product')
                                        ->where('payed', 1)
                                        ->orderBy('payed_at', 'desc')
                                        ->orderBy('receiving_date', 'asc')
                                        ->orderBy('receiving_time', 'asc')->get();
                        }

                        $response['orders'] = $orders;

                } catch (\Exception $e){
                        print_r($e->getMessage()); exit();
                    $statusCode = 400;
                }finally{
                    return response()->json($response, $statusCode);
                }
        }

        public function view($id) {

                $shops = [];

                if($this->user->admin) {
                        $order = Order::with('orderLists.product')->where('id', $id)->firstOrFail();
                        $shop = $order->shop;
                        $shops = Shop::where('id', '!=', $shop->id)->get();
                } else {
                        $shop = $this->user->getShop();
                        $order = $shop->orders()->with('orderLists.product')->where('id', $id)->firstOrFail();
                }

                return view('admin.orders.view', [
                        'order' => $order,
                        'shops' => $shops
                ]);
        }

        public function update($id, Request $request) {
                if($this->user->admin) {
                        $order = Order::with('orderLists.product')->where('id', $id)->firstOrFail();
                } else {
                        $order = $this->user->getShop()->orders()->with('orderLists.product')->where('id', $id)->firstOrFail();
                }

                if(!empty($request->status) && $request->status != $order->status) {
                        switch ($request->status) {
                                case Order::$STATUS_NEW:
                                        if($this->user->admin) {
                                                $order->status = Order::$STATUS_NEW;
                                                if($order->save()) {

                                                }
                                        }
                                        break;
                                case Order::$STATUS_ACCEPTED:
                                        if($order->status == Order::$STATUS_NEW) {
                                                $order->status = Order::$STATUS_ACCEPTED;
                                                if($order->save()) {
                                                        $order->changeStatusNotification();
                                                }
                                        }
                                        break;

                                case Order::$STATUS_COMPLETED:
                                        if($order->status == Order::$STATUS_ACCEPTED) {
                                                $order->status = Order::$STATUS_COMPLETED;
                                                $order->save();
                                                $order->createTransaction();
                                        }
                                        break;
                        }

                        if($request->ajax()){
                                return response()->json([
                                        'error' => false,
                                        'message' => 'Статус изменен',
                                        'code' => 200
                                ], 200);
                        }
                }

                if($this->user->admin) {
                        if(!empty($request->shop_id) && $request->shop_id != $order->shop_id) {
                                $order->shop_id = $request->shop_id;
                                if($order->save()) {
                                        $shop = $order->shop;
                                        if($shop->phone) {
                                                try {
                                                        Sms::instance()->send($shop->phone, 'У Вас новый заказ!');
                                                } catch(\Exception $e){

                                                }
                                        }

                                        \Session::flash('layoutWarning', ['type' => 'success', 'text' => 'Заказ успешно передан другому магазину']);
                                }
                        }

                        if(isset($request->payed)) {
                                $order->payed = (int)$request->payed;
                                $order->payed_at = \Carbon::now()->format('Y-m-d H:i:s');

                                if($order->save()) {
                                        if($order->payed) {
                                                $this->sendSuccessSms($order);
                                                $this->sendSuccessEmails($order);
                                        }
                                }
                        }
                }

                return back();
        }

        function details($key) {
                $order = Order::where('key', $key)->firstOrFail();

                /*
                Mail::send('email.clientNewOrder', ['order' => $order, ], function ($message) use ($order) {
                                $message->to('nkornushin@gmail.com')
                                        ->subject('Заказ №'. $order->id .' оплачен!');
                        });
                */

                return view('front.order.details',[
                        'order' => $order
                ]);
        }
        
        function charge($order_id, Request $request) {

                $charge = Input::all();

                $validator = Validator::make($charge, OrderCharge::$chargeRules, OrderCharge::$chargeRulesMessages);

                if ($validator->fails()) {

                    return response()->json([
                        'error' => true,
                        'message' => $validator->messages()->first(),
                        'code' => 400
                    ], 400);

                }

                $charge = new OrderCharge();
                $charge->amount = $request->input('amount');
                $charge->order_id = $request->input('order_id');
                $charge->description = $request->input('description');

                if(!empty($request->input('phone'))) {
                        $charge->phone = AppHelper::normalizePhone($request->input('phone'));
                }

                if(!empty($request->input('email'))) {
                        $charge->email = $request->input('email');
                }

                if(!empty($request->input('comment'))) {
                        $charge->comment = $request->input('comment');
                }

                if($charge->save()) {
                        $createBillResult = $charge->createBill();
                        if($createBillResult['success']) {
                                return response()->json([
                                        'error' => false,
                                        'message' => 'Счет на оплату успешно создан:<br>'.$charge->url,
                                        'code' => 200
                                ], 200);
                        } else {
                                return response()->json([
                                        'error' => true,
                                        'message' => $createBillResult['message'],
                                        'code' => 400
                                ], 400);
                        }
                }

                return response()->json([
                        'error' => true,
                        'message' => 'Ошибка. Попробуйте позже или обратитесь к администратору',
                        'code' => 400
                ], 400);
        }
}

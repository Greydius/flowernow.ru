<?php

namespace App\Http\Controllers;

use App\Model\Product;
use App\Model\Order;
use App\Model\OrderList;
use App\Helpers\Sms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class OrdersController extends Controller
{
    //

        function add($productId) {

                $product = Product::with('shop.city')->with('compositions.flower')->findOrFail($productId);

                return view('front.order.add',[
                        'product' => $product
                ]);
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
                                        $productModel[] = Product::find($product_id);
                                }

                                if(!empty($productModel)) {
                                        $shop_id = $productModel[0]->shop_id;
                                }

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

                                if($order->save()) {
                                        foreach ($productModel as $item) {
                                                $orderList = new OrderList();
                                                $orderList->order_id = $order->id;
                                                $orderList->product_id = $item->id;
                                                $orderList->single = 0;
                                                $orderList->qty = !empty((int)$request->qty) ? (int)$request->qty : 1;
                                                $orderList->shop_price = $item->price;
                                                $orderList->client_price = $item->clientPrice * $orderList->qty;

                                                $orderListCount += (int)$orderList->save();
                                        }
                                }

                                if($orderListCount) {
                                        \DB::commit();
                                        return response()->json([
                                                'order_id' => $order->id,
                                                'message' => '',
                                                'cloudpayments' => [
                                                        'publicId'      => \Config::get('cloudpayments.publicId'),  //id из личного кабинета
                                                        'description'   => 'Заказ №'.$order->id, //назначение
                                                        'amount'        => $order->amount(), //сумма
                                                        'currency'      => 'RUB', //валюта
                                                        'invoiceId'     => $order->id, //номер заказа  (необязательно)
                                                        'accountId'     => $order->email, //идентификатор плательщика (необязательно)
                                                ],
                                                'code' => 200
                                        ], 200);

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
                                        'message' => 'Ошибка! Обратитесь в службу поддержки.('.$e->getMessage().')',
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
                        if($order->save()) {
                                $this->sendSuccessSms($order);
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
                                Sms::instance()->send($shop->phone, 'У Вас новый заказ!');
                        }

                        if($order->phone) {
                                Sms::instance()->send($order->phone, 'Спасибо за оплату. Номер вашего заказа '.$order->id);
                        }

                } catch (\Exception $e) {

                }
        }

        function success() {
                return view('front.order.success',[]);
        }

        function orders() {
                $orders = $this->user->getShop()->orders()->with('orderLists.product')->where('payed', 1)->orderBy('receiving_date', 'asc')->orderBy('receiving_time', 'asc')->get();

                return view('admin.orders.list', [
                        'orders' => $orders
                ]);
        }

        public function apiList() {

                $statusCode = 200;
                $response = [
                        'orders' => []
                ];

                try{
                        if($this->user->admin) {

                        } else {

                        }

                        $response['orders'] = $this->user->getShop()->orders()->with('orderLists.product')->where('payed', 1)->orderBy('receiving_date', 'asc')->orderBy('receiving_time', 'asc')->get();

                } catch (\Exception $e){
                    $statusCode = 400;
                }finally{
                    return response()->json($response, $statusCode);
                }
        }

        public function view($id) {
                $order = $this->user->getShop()->orders()->with('orderLists.product')->where('id', $id)->firstOrFail();

                return view('admin.orders.view', [
                        'order' => $order
                ]);
        }

        public function update($id, Request $request) {
                $order = $this->user->getShop()->orders()->with('orderLists.product')->where('id', $id)->firstOrFail();

                if(!empty($request->status) && $request->status != $order->status) {
                        switch ($request->status) {
                                case Order::$STATUS_NEW:
                                        if($this->user->admin) {
                                                $order->status = Order::$STATUS_NEW;
                                                $order->save();
                                        }
                                        break;
                                case Order::$STATUS_ACCEPTED:
                                        if($order->status == Order::$STATUS_NEW) {
                                                $order->status = Order::$STATUS_ACCEPTED;
                                                $order->save();
                                        }
                                        break;

                                case Order::$STATUS_COMPLETED:
                                        if($order->status == Order::$STATUS_ACCEPTED) {
                                                $order->status = Order::$STATUS_COMPLETED;
                                                $order->save();
                                        }
                                        break;
                        }
                }

                return back();
        }
}

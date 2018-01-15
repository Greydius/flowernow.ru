<?php

namespace App\Http\Controllers;

use App\Model\Product;
use App\Model\Order;
use App\Model\OrderList;
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

                                $order = new Order();
                                $order->shop_id = $shop_id;
                                $order->recipient_name = $request->recipient_name;
                                $order->recipient_phone = $request->recipient_phone;
                                $order->recipient_address = $request->recipient_address;
                                $order->recipient_flat = $request->recipient_flat;
                                $order->recipient_self = !empty($request->recipient_self) ? 1 : 0;
                                $order->receiving_date = $request->receiving_date;
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
                                                $orderList->flower_id = $item->id;
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
}

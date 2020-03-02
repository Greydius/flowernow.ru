<?php

namespace App\Http\Controllers\Api\Orders;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use App\Model\Order;
use App\Model\OrderList;
use App\Model\Product;
use App\Model\ProductType;
use App\Model\PromoCode;

/** 
 * @group Orders
 * 
 * Orders actions
*/

class OrdersController extends Controller
{
  /** 
   * @response [
    {
        "id": 37439,
        "shop_id": 397,
        "city_id": null,
        "recipient_name": "Александр",
        "recipient_phone": "+79517584767",
        "recipient_address": "Псков Госпитальная",
        "recipient_flat": null,
        "recipient_info": null,
        "recipient_self": 0,
        "receiving_date": "2018-10-18",
        "receiving_time": "с 22:00 до 23:00",
        "anonymous": 0,
        "name": null,
        "phone": "+79052122383",
        "email": null,
        "text": null,
        "status": "new",
        "payed": 1,
        "payment": "cash",
        "key": "zijc4fxyHThTOEFr",
        "payed_at": null,
        "delivery_out_distance": 0,
        "delivery_out_price": null,
        "delivery_price": "0.00",
        "ur_name": null,
        "ur_inn": null,
        "ur_kpp": null,
        "ur_address": null,
        "ur_bank": null,
        "ur_email": "",
        "promo_code_id": null,
        "confirmed": 0,
        "photo": null,
        "finance_comment": null,
        "accepted_at": null,
        "recipient_photo": 0,
        "prev_shop_id": null,
        "amount": 2400,
        "amountShop": -400,
        "receivingDateFormat": "18 октября 2018",
        "payedDateFormat": null,
        "createdAtFormat": "18 октября 2018 11:59",
        "order_lists": [
            {
                "id": 460,
                "order_id": 37439,
                "product_id": 48513,
                "single": 0,
                "qty": 1,
                "shop_price": 2000,
                "client_price": 2400,
                "created_at": "2018-10-18 11:59:37",
                "updated_at": "2018-10-18 11:59:37",
                "package_id": null,
                "package_price": 0,
                "product": {
                    "id": 48513,
                    "shop_id": 397,
                    "name": "Образец стиля.",
                    "slug": "obrazets-stilya-431",
                    "price": 5,
                    "description": "ТЕСТ",
                    "photo": "p397_1539851897_77754.jpg",
                    "make_time": 90,
                    "width": 10,
                    "height": 20,
                    "dop": 0,
                    "approved": 0,
                    "color_id": 6,
                    "product_type_id": 1,
                    "status": 1,
                    "status_comment": null,
                    "pause": 1,
                    "special_offer_id": null,
                    "sort": 3409335,
                    "single": null,
                    "status_comment_at": null,
                    "star": 0,
                    "block_id": 5,
                    "clientPrice": 7,
                    "url": "https://floristum.ru/flowers/obrazets-stilya-431",
                    "photoUrl": "/uploads/products/397/351x351_c/p397_1539851897_77754.jpg",
                    "fullPrice": 7,
                    "deliveryTime": "1ч. 30мин.",
                    "shop": {
                        "id": 397,
                        "name": "SEATTLE",
                        "logo": null,
                        "photo": null,
                        "about": "Цветы",
                        "city_id": 645450,
                        "contact_phone": "+7(905)212-23-83",
                        "site": null,
                        "vk": null,
                        "ok": null,
                        "fb": null,
                        "instagram": null,
                        "youtube": null,
                        "delivery_price": "0.00",
                        "delivery_time": 0,
                        "delivery_out": 1,
                        "delivery_out_max": 0,
                        "delivery_out_price": "0.00",
                        "round_clock": 0,
                        "active": 1,
                        "delivery_free": 1
                    }
                }
            }
        ]
    }
]
  */
        public function orders(Request $request) {
                // If the Content-Type and Accept headers are set to 'application/json',
                // this will return a JSON structure. This will be cleaned up later.
                $user = $request->user();
                $shop = $user->getShop();

                //]]$request->status = 1;

                switch($request->status) {
                        case 1:
                                $status = 'new';
                                break;
                        case 2:
                                $status = 'accepted';
                                break;
                        default:
                                $status = 'completed';
                }

                $model = Order::where('shop_id', $shop->id)->with('orderLists.product')->orderBy('status');
                if(!empty($request->status)) {
                        $model->where('status', $status);
                }

                return $model->get();
        }

        /**
         * @response {
    "id": 37439,
    "shop_id": 397,
    "city_id": null,
    "recipient_name": "Александр",
    "recipient_phone": "+79517584767",
    "recipient_address": "Псков Госпитальная",
    "recipient_flat": null,
    "recipient_info": null,
    "recipient_self": 0,
    "receiving_date": "2018-10-18",
    "receiving_time": "с 22:00 до 23:00",
    "anonymous": 0,
    "name": null,
    "phone": "+79052122383",
    "email": null,
    "text": null,
    "status": "new",
    "payed": 1,
    "payment": "cash",
    "key": "zijc4fxyHThTOEFr",
    "payed_at": null,
    "delivery_out_distance": 0,
    "delivery_out_price": null,
    "delivery_price": "0.00",
    "ur_name": null,
    "ur_inn": null,
    "ur_kpp": null,
    "ur_address": null,
    "ur_bank": null,
    "ur_email": "",
    "promo_code_id": null,
    "confirmed": 0,
    "photo": null,
    "finance_comment": null,
    "accepted_at": null,
    "recipient_photo": 0,
    "prev_shop_id": null,
    "amount": 2400,
    "amountShop": -400,
    "receivingDateFormat": "18 октября 2018",
    "payedDateFormat": null,
    "createdAtFormat": "18 октября 2018 11:59"
}
         */

        public function order($id, Request $request) {
                $user = $request->user();
                $shop = $user->getShop();

                \Log::debug('status = '.$request->status);

                $order = Order::where('id',$id)->where('shop_id', $shop->id)->firstOrFail();
                if(!empty($request->status)) {
                        $order->status = $request->status;
                        $order->save();
                }

                return $order;
        }

        /**
         * @response [
    {
        "id": 37463,
        "shop_id": -1,
        "city_id": 645450,
        "recipient_name": "+79192262494",
        "recipient_phone": "+79113690862",
        "recipient_address": "Яна Фабрициуса 21а",
        "recipient_flat": null,
        "recipient_info": "+7 (919) 226-24-94",
        "recipient_self": 0,
        "receiving_date": "2018-11-09",
        "receiving_time": "с 09:00 до 10:00",
        "anonymous": 0,
        "name": "Семья Махницких",
        "phone": "+79192262494",
        "email": "Nadyshka80@mail.ru",
        "text": null,
        "status": "new",
        "payed": 0,
        "payment": "card",
        "key": "ZknBKZkrUcn4jR7l",
        "payed_at": null,
        "delivery_out_distance": 0,
        "delivery_out_price": null,
        "delivery_price": "150.00",
        "ur_name": null,
        "ur_inn": null,
        "ur_kpp": null,
        "ur_address": null,
        "ur_bank": null,
        "ur_email": "",
        "promo_code_id": null,
        "confirmed": 1,
        "photo": null,
        "finance_comment": null,
        "accepted_at": null,
        "recipient_photo": 0,
        "prev_shop_id": 191,
        "amount": 1710,
        "amountShop": 1450,
        "receivingDateFormat": "09 ноября 2018",
        "payedDateFormat": null,
        "createdAtFormat": "09 ноября 2018 08:44",
        "order_lists": [
            {
                "id": 484,
                "order_id": 37463,
                "product_id": 18121,
                "single": 0,
                "qty": 1,
                "shop_price": 1300,
                "client_price": 1710,
                "created_at": "2018-11-09 08:44:19",
                "updated_at": "2018-11-09 08:44:19",
                "package_id": null,
                "package_price": 0,
                "product": {
                    "id": 18121,
                    "shop_id": 191,
                    "name": "Букет №5",
                    "slug": "buket-5-1525362195",
                    "price": 1495,
                    "description": "Необычный букет , как взрыв эмоций !",
                    "photo": "p191_1525362195_21203.jpeg",
                    "make_time": 60,
                    "width": 60,
                    "height": 60,
                    "dop": 0,
                    "approved": 0,
                    "color_id": 10,
                    "product_type_id": 2,
                    "status": 1,
                    "status_comment": null,
                    "pause": 0,
                    "special_offer_id": null,
                    "sort": 6575085,
                    "single": null,
                    "status_comment_at": null,
                    "star": 0,
                    "block_id": 2,
                    "clientPrice": 2094,
                    "url": "https://floristum.ru/flowers/buket-5-1525362195",
                    "photoUrl": "/uploads/products/191/351x351_c/p191_1525362195_21203.jpeg",
                    "fullPrice": 2094,
                    "deliveryTime": "1ч.",
                    "shop": {
                        "id": 191,
                        "name": "Katrina’s",
                        "logo": "/uploads/shops/220/logo_220_1525358407.jpeg",
                        "photo": "/uploads/shops/220/photo_220_1525358463.jpeg",
                        "about": "Мы работаем для вас в любое время",
                        "city_id": 645450,
                        "contact_phone": "+7(911)893-66-36",
                        "site": null,
                        "vk": null,
                        "ok": null,
                        "fb": null,
                        "instagram": "Katrinas_17",
                        "youtube": null,
                        "delivery_price": "150.00",
                        "delivery_time": 45,
                        "delivery_out": 1,
                        "delivery_out_max": 100,
                        "delivery_out_price": "12.00",
                        "round_clock": 0,
                        "active": 1,
                        "delivery_free": 0
                    }
                }
            }
        ]
    }
    ]
         */

        public function freeOrders(Request $request) {
                // If the Content-Type and Accept headers are set to 'application/json',
                // this will return a JSON structure. This will be cleaned up later.
                $user = $request->user();
                $shop = $user->getShop();

                switch($request->status) {
                        case 1:
                                $status = 'new';
                                break;
                        case 2:
                                $status = 'accepted';
                                break;
                        default:
                                $status = 'completed';
                }
                
                $model = Order::where('shop_id', '-1')->where('city_id', $shop->city_id)->where('prev_shop_id', '!=', $shop->id)->with('orderLists.product');
                if(!empty($request->status)) {
                        $model->where('status', $status);
                }

                return $model->get();
        }

        /**
         * @response {
    "id": 37463,
    "shop_id": 397,
    "city_id": 645450,
    "recipient_name": "+79192262494",
    "recipient_phone": "+79113690862",
    "recipient_address": "Яна Фабрициуса 21а",
    "recipient_flat": null,
    "recipient_info": "+7 (919) 226-24-94",
    "recipient_self": 0,
    "receiving_date": "2018-11-09",
    "receiving_time": "с 09:00 до 10:00",
    "anonymous": 0,
    "name": "Семья Махницких",
    "phone": "+79192262494",
    "email": "Nadyshka80@mail.ru",
    "text": null,
    "status": 2,
    "payed": 0,
    "payment": "card",
    "key": "ZknBKZkrUcn4jR7l",
    "payed_at": null,
    "delivery_out_distance": 0,
    "delivery_out_price": null,
    "delivery_price": "150.00",
    "ur_name": null,
    "ur_inn": null,
    "ur_kpp": null,
    "ur_address": null,
    "ur_bank": null,
    "ur_email": "",
    "promo_code_id": null,
    "confirmed": 1,
    "photo": null,
    "finance_comment": null,
    "accepted_at": null,
    "recipient_photo": 0,
    "prev_shop_id": 191,
    "amount": 1710,
    "amountShop": 1450,
    "receivingDateFormat": "09 ноября 2018",
    "payedDateFormat": null,
    "createdAtFormat": "09 ноября 2018 08:44"
}
         */

        public function acceptFreeOrder($id, Request $request) {
                $user = $request->user();
                $shop = $user->getShop();

                \Log::debug('status = '.$request->status);

                $order = Order::where('id',$id)->firstOrFail();
                if($order->shop_id == -1) {
                        $order->shop_id = $shop->id;
                        $order->status = 2;
                        $order->save();
                } else {
                        return response()->json(['error' => 'Этот заказ уже занят'], 500);
                }

                return $order;
        }

        /**
         * @response {
    "id": 37463,
    "shop_id": 397,
    "city_id": 645450,
    "recipient_name": "+79192262494",
    "recipient_phone": "+79113690862",
    "recipient_address": "Яна Фабрициуса 21а",
    "recipient_flat": null,
    "recipient_info": "+7 (919) 226-24-94",
    "recipient_self": 0,
    "receiving_date": "2018-11-09",
    "receiving_time": "с 09:00 до 10:00",
    "anonymous": 0,
    "name": "Семья Махницких",
    "phone": "+79192262494",
    "email": "Nadyshka80@mail.ru",
    "text": null,
    "status": "accepted",
    "payed": 0,
    "payment": "card",
    "key": "ZknBKZkrUcn4jR7l",
    "payed_at": null,
    "delivery_out_distance": 0,
    "delivery_out_price": null,
    "delivery_price": "150.00",
    "ur_name": null,
    "ur_inn": null,
    "ur_kpp": null,
    "ur_address": null,
    "ur_bank": null,
    "ur_email": "",
    "promo_code_id": null,
    "confirmed": 1,
    "photo": null,
    "finance_comment": null,
    "accepted_at": null,
    "recipient_photo": 0,
    "prev_shop_id": 191,
    "amount": 1710,
    "amountShop": 1450,
    "receivingDateFormat": "09 ноября 2018",
    "payedDateFormat": null,
    "createdAtFormat": "09 ноября 2018 08:44"
}
         */

        public function rejectionOrder($id, Request $request) {
                $user = $request->user();
                $shop = $user->getShop();

                $order = Order::where('id',$id)->where('shop_id', $shop->id)->firstOrFail();

                if($order->status == 'new') {
                        $order->rejection();
                }

                return $order;
        }

        /**
         * submit
         * Required:
         * * order_id
         * * cardHolderName
         * * cryptogram
         * 
         * @response {
    "error": false,
    "message": "Успешно",
    "order": {
        "id": 40596,
        "shop_id": 869,
        "city_id": null,
        "recipient_name": null,
        "recipient_phone": null,
        "recipient_address": null,
        "recipient_flat": null,
        "recipient_info": null,
        "recipient_self": 0,
        "receiving_date": "2020-02-27",
        "receiving_time": "Согласовать",
        "anonymous": 1,
        "name": null,
        "phone": "11111",
        "email": null,
        "text": null,
        "status": "new",
        "payed": 0,
        "payment": "card",
        "key": "OifLzhnJyPjFy2he",
        "payed_at": null,
        "delivery_out_distance": 0,
        "delivery_out_price": null,
        "delivery_price": "510.00",
        "ur_name": null,
        "ur_inn": null,
        "ur_kpp": null,
        "ur_address": null,
        "ur_bank": null,
        "ur_email": "",
        "promo_code_id": 2798,
        "confirmed": 1,
        "photo": null,
        "finance_comment": null,
        "accepted_at": null,
        "recipient_photo": 0,
        "prev_shop_id": null,
        "amount": 14,
        "amountShop": 1156,
        "receivingDateFormat": "27 февраля 2020",
        "payedDateFormat": null,
        "createdAtFormat": "27 февраля 2020 02:24"
    },
    "order_list": {
        "id": 3600,
        "order_id": 40596,
        "product_id": 117356,
        "single": 0,
        "qty": 1,
        "shop_price": 646,
        "client_price": 14,
        "created_at": "2020-02-27 02:24:43",
        "updated_at": "2020-02-27 02:24:43",
        "package_id": null,
        "package_price": 0
    },
    "result": {
        "Model": {
            "TransactionId": 308907076,
            "PaReq": "eJxVUU1zgjAQ/SsMd0yI4ctZ4tBqpx6kTouHHiNEpSOgATrqr2+CoDanfW+zu2/fwvRcHIxfIeu8KkPTHmHTEGVaZXm5C8118mb55pRBspdCzL5E2krBYCnqmu+EkWeh6eKtH2CPWP6GcIti4Vp8oyAlgeAu5YGHbZPBKvoUJwb9IKbmjAigAaqOMt3zsmHA09PLImaEYOxhQD2EQsjFjCny/jw7AHSjoeSFYNtDJfO6aYuRbAF1FKRVWzbywlw6BjQAaOWB7ZvmOEHouQgB0hlADzWrVke16nTOMxYnEY6vEV0mc/tjthjHP3NneV1fPpLvEJD+ARlvhJKphBLiGRhPsDMZO4A6HnihJTCbYr3aDcBRz4ieM88MKMulusiww4BAnI9VKdQP5eM9BvRQ/Pqu3UwbZZCPA0qp4xJbO9pRuj5XZiij3a6BBoB0EeqPhfo7q+jf/f8A5tG1Qg==",
            "AcsUrl": "https://ds1.mirconnect.ru:443/sc/pareq",
            "IFrameIsAllowed": true,
            "FrameWidth": null,
            "FrameHeight": null
        },
        "InnerResult": null,
        "Success": false,
        "Message": null
    },
    "code": 200
}
         */
        public function submit(Request $request) {
                $order_id = $request->order_id;
                if($order_id) {
                  $order = Order::find($order_id);
                  $orderList = OrderList::where('order_id', '=', $order_id)->firstOrFail();
                  $transaction = null;
                  $client = null;
                  if(!empty($order)){
                    try {
                      // $client = new \CloudPayments\Manager(\Config::get('cloudpayments.publicId'), \Config::get('cloudpayments.pwd'));
                      // $client = new \CloudPayments\Manager('pk_b9fae63a24c9731f3ad2f3b367b8b', 'a32f1f45a80da2b008a39d59093e2fc5');
                      function prepareHeaders($headers) {
                        $flattened = array();

                        foreach ($headers as $key => $header) {
                          if (is_int($key)) {
                            $flattened[] = $header;
                          } else {
                            $flattened[] = $key.': '.$header;
                          }
                        }

                        return implode("\r\n", $flattened);
                      }
                      $ipAddress = '87.236.16.11';
                      $cardHolderName = $request->cardHolderName;
                      $cryptogram = $request->cryptogram;
                      $params = [];
                      // $transaction = $client->chargeCard($orderList->client_price, 'RUB', $ipAddress, $cardHolderName, $cryptogram, $params = [], $requireConfirmation = false);
                      $url = 'https://api.cloudpayments.ru/payments/cards/charge';
                      $data = array(
                        'Amount' => $orderList->client_price, 
                        'Currency' => 'RUB',
                        'IpAddress' => $ipAddress,
                        'Name' => $cardHolderName,
                        'CardCryptogramPacket' => $cryptogram,
                        'InvoiceId' => $order_id
                      );

                      $headers = array(
                        'Content-Type' => 'application/x-www-form-urlencoded',
                        'Authorization' => 'Basic cGtfNTBlMzYyMmUwMmIzMWVjNjFiZmJkZjJkYTNhMGM6OTI2YThhODliMzMwMjMwYjdjMjRmZmZhZjY3NzE5YTI=',
                      );
                      $options = array(
                          'http' => array(
                              'header'  => prepareHeaders($headers),
                              'method'  => 'POST',
                              'content' => http_build_query($data)
                          )
                      );
                      $context  = stream_context_create($options);
                      $result = file_get_contents($url, false, $context);

                      return response()->json([
                              'error' => false,
                              'message' => 'Успешно',
                              'order' => $order,
                              'order_list' => $orderList,
                              'result' => json_decode($result),
                              'code' => 200
                      ], 200);
                    } catch(\Exception $e) {
                      return response()->json([
                              'error' => true,
                              'e' => $e,
                              'message' => 'Ошибка транзакции',
                              'params' => [
                                'price' => $orderList->client_price,
                                'ipAddress' => $ipAddress,
                                'cardHolderName' => $cardHolderName, 
                                'cryptogram' => $cryptogram
                              ],
                              'code' => 400
                      ], 400);
                    }
                  } else {
                    return response()->json([
                            'error' => true,
                            'message' => 'Заказ не найден',
                            'code' => 400
                    ], 400);
                  }
                }else {
                  return response()->json([
                          'error' => true,
                          'message' => 'Требуется order_id',
                          'code' => 400
                  ], 400);
                }
        }

        /**
         * post3ds
         * * transactionId -> int
         * * paRes => string
         * @response {
    "error": false,
    "message": "Успешно",
    "result": {
        "Model": {
            "ReasonCode": 5006
        },
        "InnerResult": null,
        "Success": false,
        "Message": "Транзакция не найдена"
    },
    "code": 200
}
         */

        public function post3ds(Request $request) {
                $tID = $request->transactionId;
                $paRes = $request->paRes;
                if($tID != '' && $paRes != '') {
                  
                    try {
                        function prepareHeaders($headers) {
                        $flattened = array();

                        foreach ($headers as $key => $header) {
                          if (is_int($key)) {
                            $flattened[] = $header;
                          } else {
                            $flattened[] = $key.': '.$header;
                          }
                        }

                        return implode("\r\n", $flattened);
                      }
                      
                      $url = 'https://api.cloudpayments.ru/payments/cards/post3ds';
                      $data = array(
                        'TransactionId' => $tID, 
                        'PaRes' => $paRes,
                      );

                      $headers = array(
                        'Content-Type' => 'application/x-www-form-urlencoded',
                        'Authorization' => 'Basic cGtfNTBlMzYyMmUwMmIzMWVjNjFiZmJkZjJkYTNhMGM6OTI2YThhODliMzMwMjMwYjdjMjRmZmZhZjY3NzE5YTI=',
                      );
                      $options = array(
                          'http' => array(
                              'header'  => prepareHeaders($headers),
                              'method'  => 'POST',
                              'content' => http_build_query($data)
                          )
                      );
                      $context  = stream_context_create($options);
                      $result = file_get_contents($url, false, $context);

                      return response()->json([
                              'error' => false,
                              'message' => 'Успешно',
                              'result' => json_decode($result),
                              'code' => 200
                      ], 200);
                    } catch(\Exception $e) {
                      return response()->json([
                              'error' => true,
                              'e' => $e,
                              'message' => 'Ошибка',
                              'params' => [
                                'price' => $orderList->client_price,
                                'ipAddress' => $ipAddress,
                                'cardHolderName' => $cardHolderName, 
                                'cryptogram' => $cryptogram
                              ],
                              'code' => 400
                      ], 400);
                    }
                }else {
                  return response()->json([
                          'error' => true,
                          'message' => 'Требуется transactionId и paRes',
                          'code' => 400
                  ], 400);
                }
        }

        /**
         * checkPromoCode
         * * code => 'string' || code || XZ2G4
         * @response {
    "error": false,
    "data": {
        "id": 1,
        "code": "XZ2G4",
        "value": 5,
        "code_type": "percent",
        "settings": null,
        "used_on": "2018-03-29 14:35:29",
        "created_at": "2018-03-29 10:41:37",
        "updated_at": "2018-03-29 14:35:29",
        "reusable": 0,
        "text": "5%"
    },
    "code": 200
}
         */

        public function checkPromoCode(Request $request) {
                $code = $request->code;

                if($code) {
                  $promoCode = PromoCode::where('code', '=', $code)->get();
                  if(count($promoCode) > 0) {
                    return response()->json([
                            'error' => false,
                            'data' => $promoCode[0],
                            'code' => 200
                    ], 200);
                  } else {
                    return response()->json([
                            'error' => true,
                            'message' => 'Не найдено',
                            'code' => 404
                    ], 404);
                  }
                }else {
                  return response()->json([
                          'error' => true,
                          'message' => 'Требуется code',
                          'code' => 400
                  ], 400);
                }
        }
}
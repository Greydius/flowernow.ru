<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['namespace' => 'Api'], function () {
        Route::group(['namespace' => 'Auth'], function () {
                Route::post('register', 'RegisterController');
                Route::post('login', 'LoginController');
                Route::post('logout', 'LogoutController')->middleware('auth:api');
        });

        Route::get('/cities', function(Request $request) {

                $cities = App\Model\City::whereNotNull('slug')->with(['region'])->orderBy('population', 'DESC')->get();

                return $cities;
        });

        Route::get('/main/{cityId}', function($cityId, Request $request) {
                $return = [];
                $popularProducts = [];
                $innerRequest = new Request();

                $productTypes = App\Model\ProductType::select(['id', 'name'])->where('show_on_main', '1')->inCity($cityId)->orderBy('priority')->get();
                foreach($productTypes as $productType) {
                        $productType->request = 'productType/'.$productType->id;

                        $innerRequest->productType = $productType->id;
                        $_popularProduct = [
                                'name' => $productType->name,
                                'products' => App\Model\Product::popular($cityId, $innerRequest, 1, 8),
                                'request' => 'products/'.$productType->id
                        ];

                        $popularProducts[] = $_popularProduct;
                }
                $return['productTypes'] = $productTypes;
                $return['products'] = $popularProducts;


                return $return;
        });

});

Route::group(['namespace' => 'Api', 'middleware' => 'auth:api'], function() {
        Route::get('/orders', function(Request $request) {
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

                $model = App\Model\Order::where('shop_id', $shop->id)->with('orderLists.product')->orderBy('status');
                if(!empty($request->status)) {
                        $model->where('status', $status);
                }

                return $model->get();
        });

        Route::post('/order/{id}', function($id, Request $request) {
                $user = $request->user();
                $shop = $user->getShop();

                \Log::debug('status = '.$request->status);

                $order = App\Model\Order::where('id',$id)->where('shop_id', $shop->id)->firstOrFail();
                if(!empty($request->status)) {
                        $order->status = $request->status;
                        $order->save();
                }

                return $order;
        });

        Route::post('/user/addFirebaseToken', function(Request $request) {
                $user = $request->user();
                if(!empty($request->token)) {
                        $user->firebase_token = $request->token;
                        return $user->save();
                }

                return false;
        });

        Route::get('/freeOrders', function(Request $request) {
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
                
                $model = App\Model\Order::where('shop_id', '-1')->where('city_id', $shop->city_id)->where('prev_shop_id', '!=', $shop->id)->with('orderLists.product');
                if(!empty($request->status)) {
                        $model->where('status', $status);
                }

                return $model->get();
        });

        Route::post('/acceptFreeOrder/{id}', function($id, Request $request) {
                $user = $request->user();
                $shop = $user->getShop();

                \Log::debug('status = '.$request->status);

                $order = App\Model\Order::where('id',$id)->firstOrFail();
                if($order->shop_id == -1) {
                        $order->shop_id = $shop->id;
                        $order->status = 2;
                        $order->save();
                } else {
                        return response()->json(['error' => 'Этот заказ уже занят'], 500);
                }

                return $order;
        });

        Route::post('/rejectionOrder/{id}', function($id, Request $request) {
                $user = $request->user();
                $shop = $user->getShop();

                $order = App\Model\Order::where('id',$id)->where('shop_id', $shop->id)->firstOrFail();

                if($order->status == 'new') {
                        $order->rejection();
                }

                return $order;
        });
});
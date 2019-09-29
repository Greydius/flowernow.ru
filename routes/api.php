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
});

Route::group(['namespace' => 'Api', 'middleware' => 'auth:api'], function() {
        Route::get('/orders', function(Request $request) {
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

                return App\Model\Order::where('shop_id', $shop->id)->with('orderLists.product')->where('status', $status)->get();
        });
});
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


Route::group(['namespace' => 'Api'], function () {
        Route::group(['namespace' => 'Auth'], function () {
                Route::post('register', 'RegisterController');
                Route::post('login', 'LoginController');
                Route::post('logout', 'LogoutController')->middleware('auth:api');
        });

        Route::group(['namespace' => 'Cities'], function () {
          Route::get('/cities', 'CitiesController@cities');

          Route::get('/main/{cityId}', 'CitiesController@main'); 
        });

        Route::group(['namespace' => 'Orders'], function () {
          Route::post('payment/cloudpayments/submitpayment', 'OrdersController@submit');
          Route::post('payment/cloudpayments/post3ds', 'OrdersController@post3ds');
          Route::post('/checkPromoCode', 'OrdersController@checkPromoCode');
        });

        Route::get('/updateProductsCount', 'TodayCountProductsController@update');

});

Route::group(['namespace' => 'Api', 'middleware' => 'auth:api'], function() {
        Route::group(['namespace' => 'Orders'], function () {
          Route::get('/orders', 'OrdersController@orders');

          Route::post('/order/{id}', 'OrdersController@order');

          Route::get('/freeOrders', 'OrdersController@freeOrders');

          Route::post('/acceptFreeOrder/{id}', 'OrdersController@acceptFreeOrder');

          Route::post('/rejectionOrder/{id}', 'OrdersController@rejectionOrder');
        });

        Route::group(['namespace' => 'Users'], function () {
          Route::post('/user/addFirebaseToken', 'UsersController@addFirebaseToken');
          Route::get('/user', 'UsersController@user');
        });
});

Route::group(['namespace' => 'Api'], function() {
  Route::group(['prefix' => 'products', 'namespace' => 'Products'], function() {
    Route::get('/{city_id}/{category_slug}', 'ProductsController@cityCategoryProducts');
    Route::get('/{city_id}', 'ProductsController@cityProducts');
    Route::get('/', 'ProductsController@products');
  });

  Route::group(['prefix' => 'cart', 'namespace' => 'Cart'], function() {
    Route::get('/{id}', 'CartController@cart');
  });
});

Route::post('/cart', 'OrdersController@create');
Route::post('/confirmSmsCode/{id}', 'OrdersController@confirmSmsCode');

Route::post('payment/cloudpayments/createpayment', 'OrdersController@create');

Route::post('payment/cloudpayments/checkpayment', 'OrdersController@checkpayment');

Route::post('payment/cloudpayments/confirmpayment', 'OrdersController@confirmpayment');


Route::group(['namespace' => 'Api'], function() {
  Route::group(['prefix' => 'tests', 'namespace' => 'Tests'], function() {
    Route::get('/cities', 'TestsController@cities');
    Route::post('/createShops', 'TestsController@createShops');
    Route::delete('/deleteShops', 'TestsController@deleteShops');
    Route::post('/updateShop/{id}', 'TestsController@updateShop');
    Route::post('/createProducts', 'TestsController@createProducts');
    Route::get('/sendMarchEmails', 'TestsController@sendMarchEmails');
  });
});

Route::post('/sendSMSUrl', 'ToAppController@sendSMSUrl');
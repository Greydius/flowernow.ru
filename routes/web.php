<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [
        'uses' => 'ProductsController@index',
        'as' => 'front.index'
]);

Route::get('/flowers/{slug}', [
        'uses' => 'ProductsController@show',
        'as' => 'product.show'
]);

Route::get('searchCity', [
        'uses' => 'CitiesController@search',
        'as' => 'city.search'
]);

/*CART*/
Route::get('cart/{product_id}', [
        'uses' => 'OrdersController@add',
        'as' => 'order.add'
]);


Route::group(['prefix' => 'admin',  'middleware' => 'auth'], function() {

        /* SHOPS*/
        Route::get('shop', [
                'uses' => 'ShopsController@profile',
                'as' => 'admin.shop.profile'
        ]);

        Route::post('shop/uploadLogo', [
                'uses' => 'ShopsController@uploadLogo',
                'as' => 'admin.shop.uploadLogo'
        ]);

        /* PRODUCTS*/
        Route::get('products', [
                'uses' => 'ProductsController@products',
                'as' => 'admin.products'
        ]);

        Route::post('products/upload', [
                'uses' => 'ProductsController@upload',
                'as' => 'admin.products.upload'
        ]);

        Route::post('products/update', [
                'uses' => 'ProductsController@update',
                'as' => 'admin.products.update'
        ]);


        /* API */
        Route::group(['prefix' => 'api/v1'], function() {

                /* SHOPS*/
                Route::get('shop', [
                        'uses' => 'ShopsController@apiProfile',
                        'as' => 'admin.api.shop.profile'
                ]);

                /* PRODUCTS*/
                Route::get('products', [
                        'uses' => 'ProductsController@apiList',
                        'as' => 'admin.api.products.list'
                ]);
        });
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/seed/regions', [
        'uses' => 'SeedController@insertRegionData'
]);

Route::get('/seed/city', [
        'uses' => 'SeedController@insertCityData'
]);

Route::get('/register/verify/{code}', [
        'uses' => 'Auth\RegisterController@verify',
        'as' => 'register.verify'
]);

Route::post('/register/checkData', [
        'uses' => 'Auth\RegisterController@checkData',
        'as' => 'register.check.data'
]);

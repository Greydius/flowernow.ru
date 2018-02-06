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

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/flowers/{slug}', [
        'uses' => 'ProductsController@show',
        'as' => 'product.show'
]);

Route::get('/catalog/{query?}', [
        'uses' => 'ProductsController@filter',
        'as' => 'product.catalog'
])->where('query','(.*)');

Route::get('searchCity', [
        'uses' => 'CitiesController@search',
        'as' => 'city.search'
]);

/*CART*/
Route::get('cart/{product_id}', [
        'uses' => 'OrdersController@add',
        'as' => 'order.add'
]);

Route::post('cart', [
        'uses' => 'OrdersController@create',
        'as' => 'order.create'
]);

Route::get('payment/success', [
        'uses' => 'OrdersController@success',
        'as' => 'payment.success'
]);

/*Payment notifications*/
Route::post('payment/cloudpayments/checkpayment', [
        'uses' => 'OrdersController@checkpayment',
        'as' => 'cloudpayments.checkpayment'
]);

Route::post('payment/cloudpayments/confirmpayment', [
        'uses' => 'OrdersController@confirmpayment',
        'as' => 'cloudpayments.confirmpayment'
]);

Route::get('/delivery', [
        'uses' => 'HomeController@delivery',
        'as' => 'front.delivery'
]);

Route::get('/payment', [
        'uses' => 'HomeController@payment',
        'as' => 'front.payment'
]);

Route::get('/faq', [
        'uses' => 'HomeController@faq',
        'as' => 'front.faq'
]);

Route::get('/registershop', [
        'uses' => 'HomeController@registershop',
        'as' => 'front.registershop'
]);

Route::get('/corporate', [
        'uses' => 'HomeController@corporate',
        'as' => 'front.corporate'
]);

Route::get('/cities', [
        'uses' => 'CityController@popular',
        'as' => 'city.popular'
]);

/* API */
Route::group(['prefix' => 'api/v1'], function() {
        /* PRODUCTS*/
        Route::get('products', [
                'uses' => 'ProductsController@apiPopular',
                'as' => 'api.products.popular'
        ]);
});


Route::group(['prefix' => 'admin',  'middleware' => 'auth'], function() {

        /* ORDERS*/
        Route::get('orders', [
                'uses' => 'OrdersController@orders',
                'as' => 'admin.orders'
        ]);

        Route::get('order/{id}', [
                'uses' => 'OrdersController@view',
                'as' => 'admin.order.view'
        ]);

        Route::post('order/{id}', [
                'uses' => 'OrdersController@update',
                'as' => 'admin.order.update'
        ]);

        /* SHOPS*/
        Route::get('shop', [
                'uses' => 'ShopsController@profile',
                'as' => 'admin.shop.profile'
        ]);

        Route::get('shop2', [
                'uses' => 'ShopsController@profile2',
                'as' => 'admin.shop.profile2'
        ]);

        Route::post('shop/uploadLogo', [
                'uses' => 'ShopsController@uploadLogo',
                'as' => 'admin.shop.uploadLogo'
        ]);

        Route::post('shop/uploadPhoto', [
                'uses' => 'ShopsController@uploadPhoto',
                'as' => 'admin.shop.uploadPhoto'
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
                
                Route::post('product/delete/{id}', [
                        'uses' => 'ProductsController@apiProductDelete',
                        'as' => 'admin.api.product.delete'
                ]);

                /* ORDERS*/
                Route::get('orders', [
                        'uses' => 'OrdersController@apiList',
                        'as' => 'admin.api.orders.list'
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

Route::get('/seed/addCitySlug', [
        'uses' => 'SeedController@addCitySlug'
]);

Route::get('/seed/addProductTypesSlug', [
        'uses' => 'SeedController@addProductTypesSlug'
]);

Route::get('/seed/addFlowersSlug', [
        'uses' => 'SeedController@addFlowersSlug'
]);
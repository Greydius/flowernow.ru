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

Route::get('/register ', '\App\Http\Controllers\Auth\RegisterController@showRegistrationForm');

/*SHOP*/
Route::get('shop/{id}', [
        'uses' => 'ShopsController@products',
        'as' => 'shop.products'
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

Route::get('/choosePopup', [
        'uses' => 'CityController@choosePopup',
        'as' => 'city.choosePopup'
]);

Route::get('/info/agreement', [
        'uses' => 'HomeController@agreement',
        'as' => 'front.agreement'
]);

Route::get('/info/privacy', [
        'uses' => 'HomeController@privacy',
        'as' => 'front.privacy'
]);

Route::get('/info/personldata', [
        'uses' => 'HomeController@personldata',
        'as' => 'front.personldata'
]);

Route::get('/info/oferta', [
        'uses' => 'HomeController@oferta',
        'as' => 'front.oferta'
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

        Route::group(['middleware' => 'is-admin'], function () {
                Route::get('shops', [
                        'uses' => 'ShopsController@shops',
                        'as' => 'admin.shop.list'
                ]);

                Route::get('shop/{id}', [
                        'uses' => 'ShopsController@profile',
                        'as' => 'admin.shop.profile_edit'
                ]);
        });

        Route::get('shop', [
                'uses' => 'ShopsController@profile',
                'as' => 'admin.shop.profile'
        ]);

        Route::post('shop/{id}', [
                'uses' => 'ShopsController@update',
                'as' => 'admin.shop.update'
        ]);

        Route::get('shop2', [
                'uses' => 'ShopsController@profile2',
                'as' => 'admin.shop.profile2'
        ]);

        Route::post('shop/uploadLogo/{id}', [
                'uses' => 'ShopsController@uploadLogo',
                'as' => 'admin.shop.uploadLogo'
        ]);

        Route::post('shop/uploadPhoto/{id}', [
                'uses' => 'ShopsController@uploadPhoto',
                'as' => 'admin.shop.uploadPhoto'
        ]);

        /* PRODUCTS*/
        Route::get('products', [
                'uses' => 'ProductsController@products',
                'as' => 'admin.products'
        ]);

        Route::get('products2', [
                'uses' => 'ProductsController@products2',
                'as' => 'admin.products2'
        ]);

        Route::post('products/upload', [
                'uses' => 'ProductsController@upload',
                'as' => 'admin.products.upload'
        ]);

        Route::post('products/uploadPhoto/{id}', [
                'uses' => 'ProductsController@uploadPhoto',
                'as' => 'admin.products.uploadPhoto'
        ]);

        Route::post('products/update', [
                'uses' => 'ProductsController@update',
                'as' => 'admin.products.update'
        ]);


        /* API */
        Route::group(['prefix' => 'api/v1'], function() {

                /* SHOPS*/

                Route::get('shop/{id}', [
                        'uses' => 'ShopsController@apiProfile',
                        'as' => 'admin.api.shop.profile'
                ]);

                Route::get('shop', [
                        'uses' => 'ShopsController@apiProfile',
                        'as' => 'admin.api.shop.profile'
                ]);

                Route::group(['middleware' => 'is-admin'], function () {
                        Route::get('shops', [
                                'uses' => 'ShopsController@apiList',
                                'as' => 'admin.api.shops.list'
                        ]);
                });

                /* PRODUCTS*/
                Route::get('products', [
                        'uses' => 'ProductsController@apiList',
                        'as' => 'admin.api.products.list'
                ]);
                
                Route::post('product/delete/{id}', [
                        'uses' => 'ProductsController@apiProductDelete',
                        'as' => 'admin.api.product.delete'
                ]);

                Route::post('product/deletePhoto/{id}', [
                        'uses' => 'ProductsController@apiDeletePhoto',
                        'as' => 'admin.api.product.apiDeletePhoto'
                ]);

                Route::post('product/changePriority/{id}', [
                        'uses' => 'ProductsController@apiChangePriority',
                        'as' => 'admin.api.product.apiChangePriority'
                ]);

                Route::post('product/changeStatusProduct/{id}', [
                        'uses' => 'ProductsController@apiChangeStatusProduct',
                        'as' => 'admin.api.product.apiChangeStatusProduct'
                ]);

                Route::post('product/changePauseProduct/{id}', [
                        'uses' => 'ProductsController@apiChangePauseProduct',
                        'as' => 'admin.api.product.apiChangePauseProduct'
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
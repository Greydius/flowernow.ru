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
Route::get('/logi', '\App\Http\Controllers\Auth\LoginController@showLoginForm');


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

Route::get('order/{key}', [
        'uses' => 'OrdersController@details',
        'as' => 'order.details'
]);

Route::get('payment/success', [
        'uses' => 'OrdersController@success',
        'as' => 'payment.success'
]);

Route::get('payment/success-ur/{order_id}', [
        'uses' => 'OrdersController@success',
        'as' => 'payment.success_ur'
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

Route::get('/info/terms', [
        'uses' => 'HomeController@terms',
        'as' => 'front.terms'
]);

Route::get('/getPromoCodeinfo', [
        'uses' => 'PromoCodesController@getInfo',
        'as' => 'promoCodes.getInfo'
]);

/* API */
Route::group(['prefix' => 'api/v1'], function() {
        /* PRODUCTS*/
        Route::get('products', [
                'uses' => 'ProductsController@apiPopular',
                'as' => 'api.products.popular'
        ]);

        Route::get('singleProduct/getProductByQty', [
                'uses' => 'ProductsController@getProductByQty',
                'as' => 'api.products.getProductByQty'
        ]);
});


Route::group(['prefix' => 'admin',  'middleware' => 'auth'], function() {

        /*SINGLE PRODUCTS*/
        Route::get('single', [
                'uses' => 'ProductsController@single',
                'as' => 'products.single'
        ]);

        Route::get('single/{parent_id}', [
                'uses' => 'ProductsController@singleCategory',
                'as' => 'products.single.category'
        ]);
        
        Route::get('test/test', [
                'uses' => 'HomeController@test',
                'as' => 'admin.test'
        ]);

        /* FINANCE */
        Route::get('finance', [
                'uses' => 'FinanceController@index',
                'as' => 'admin.finance'
        ]);

        Route::post('finance/request', [
                'uses' => 'FinanceController@request',
                'as' => 'admin.finance.request'
        ]);

        Route::get('invoices', [
                'uses' => 'InvoicesController@index',
                'as' => 'admin.invoices'
        ]);

        /* SPECIAL OFFERS*/
        Route::get('specialOffers', [
                'uses' => 'SpecialOffersController@index',
                'as' => 'admin.specialOffers.list'
        ]);

        Route::get('specialOffers/create', [
                'uses' => 'SpecialOffersController@create',
                'as' => 'admin.specialOffers.create'
        ]);

        Route::post('specialOffers/store', [
                'uses' => 'SpecialOffersController@store',
                'as' => 'admin.specialOffers.store'
        ]);

        Route::post('specialOffers/destroy/{id}', [
                'uses' => 'SpecialOffersController@destroy',
                'as' => 'admin.specialOffers.destroy'
        ]);

        Route::get('specialOffers/edit/{id}', [
                'uses' => 'SpecialOffersController@edit',
                'as' => 'admin.specialOffers.edit'
        ]);

        Route::post('specialOffers/update/{id}', [
                'uses' => 'SpecialOffersController@update',
                'as' => 'admin.specialOffers.update'
        ]);

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

        Route::post('order/changeShop/{id}', [
                'uses' => 'OrdersController@changeShop',
                'as' => 'admin.order.changeShop'
        ]);

        /* SHOPS*/

        Route::group(['middleware' => 'is-admin'], function () {

                Route::get('promoCodes/create', [
                        'uses' => 'PromoCodesController@create',
                        'as' => 'admin.promoCodes.create'
                ]);

                Route::post('promoCodes/store', [
                        'uses' => 'PromoCodesController@store',
                        'as' => 'admin.promoCodes.store'
                ]);

                Route::get('shops', [
                        'uses' => 'ShopsController@shops',
                        'as' => 'admin.shop.list'
                ]);

                Route::get('shop/{id}', [
                        'uses' => 'ShopsController@profile',
                        'as' => 'admin.shop.profile_edit'
                ]);

                Route::get('subscriptions', [
                        'uses' => 'SubscriptionsController@index',
                        'as' => 'admin.subscription.index'
                ]);

                Route::get('subscription/create', [
                        'uses' => 'SubscriptionsController@create',
                        'as' => 'admin.subscription.create'
                ]);

                Route::get('subscription/create2', [
                        'uses' => 'SubscriptionsController@create2',
                        'as' => 'admin.subscription.create2'
                ]);

                Route::post('subscription/store', [
                        'uses' => 'SubscriptionsController@store',
                        'as' => 'admin.subscription.store'
                ]);

                Route::post('subscription/run', [
                        'uses' => 'SubscriptionsController@run',
                        'as' => 'admin.subscription.run'
                ]);

                Route::post('subscription/pause', [
                        'uses' => 'SubscriptionsController@pause',
                        'as' => 'admin.subscription.pause'
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

        Route::post('products/changePrice', [
                'uses' => 'ProductsController@changePrice',
                'as' => 'admin.products.changePrice'
        ]);


        /* API */
        Route::group(['prefix' => 'api/v1'], function() {

                /* Single Products */

                Route::post('singleProduct/savePrice/{id}', [
                        'uses' => 'ProductsController@apiSingleProductSavePrice',
                        'as' => 'admin.api.single-product.save-price'
                ]);

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


Route::post('/recover/sendCode', [
        'uses' => 'Auth\ForgotPasswordController@sendCode',
        'as' => 'recover.sendCode'
]);

Route::post('/recover/setPassword', [
        'uses' => 'Auth\ForgotPasswordController@setPassword',
        'as' => 'recover.setPassword'
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

Route::get('autologin/{token}', ['as' => 'autologin', 'uses' => '\Watson\Autologin\AutologinController@autologin']);
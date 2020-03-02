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
Route::get('/login', '\App\Http\Controllers\Auth\LoginController@showLoginForm');


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

Route::get('/favorites/', [
        'uses' => 'FavoritesController@index',
        'as' => 'favorites.show'
]);

Route::get('/catalog/{query?}', [
        'uses' => 'ProductsController@filter',
        'as' => 'product.catalog'
])->where('query','(.*)');

Route::get('searchCity', [
        'uses' => 'CitiesController@search',
        'as' => 'city.search'
]);

Route::get('search', [
        'uses' => 'ProductsController@filter',
        'as' => 'product.search'
]);

Route::get('reviews', [
        'uses' => 'FeedbackController@reviews',
        'as' => 'feedback.reviews'
]);

Route::get('review/add/{key}', [
        'uses' => 'FeedbackController@add',
        'as' => 'feedback.add'
]);

Route::post('review/add/{key}', [
        'uses' => 'FeedbackController@feedbackCreate',
        'as' => 'feedback.create'
]);

Route::get('happy-recipients', [
        'uses' => 'HomeController@happyRecipients',
        'as' => 'front.happyRecipients'
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

Route::get('/order/getInvoice/{key}', [
        'uses' => 'OrdersController@getInvoice',
        'as' => 'order.getInvoice'
]);

Route::get('/order/confirmSmsCode/{id}', [
        'uses' => 'OrdersController@confirmSmsCode',
        'as' => 'order.confirmSmsCode'
]);

Route::get('payment/success', [
        'uses' => 'OrdersController@success',
        'as' => 'payment.success'
]);

Route::get('payment/success-ur/{key}', [
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

Route::get('/toApp', [
        'uses' => 'ToAppController@redirect',
        'as' => 'toApp.redirect'
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

        Route::get('products/copy', [
                'uses' => 'ProductsController@copy',
                'as' => 'products.copy'
        ]);

        Route::post('products/copyProcess', [
                'uses' => 'ProductsController@copyProcess',
                'as' => 'products.copyProcess'
        ]);

        /*Партнерка*/
        Route::get('partnership', [
                'uses' => 'ShopsController@partnership',
                'as' => 'shops.partnership'
        ]);

        Route::post('partnershipAdd', [
                'uses' => 'ShopsController@partnershipAdd',
                'as' => 'shops.partnership.add'
        ]);
        
        /*Правила*/
        Route::get('rules', [
                'uses' => 'ShopsController@rules',
                'as' => 'shops.rules'
        ]);

        Route::get('rules/single', [
                'uses' => 'ShopsController@rulesSingle',
                'as' => 'shops.rulesSingle'
        ]);

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

        Route::get('nick/test', [
                'uses' => 'TestController@test',
                'as' => 'nick.test'
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

        Route::get('orders/rejection', [
                'uses' => 'OrdersController@rejectionList',
                'as' => 'admin.orders.rejection'
        ]);

        /* SHOPS*/

        Route::group(['middleware' => 'is-admin'], function () {

                Route::get('direct', [
                        'uses' => 'DirectController@index',
                        'as' => 'admin.directs.list'
                ]);

                Route::post('direct/update/{direct}', [
                        'uses' => 'DirectController@update',
                        'as' => 'admin.directs.update'
                ]);

                Route::get('agents', [
                        'uses' => 'AgentsController@index',
                        'as' => 'admin.agents.list'
                ]);

                Route::get('agent/edit/{city_id}', [
                        'uses' => 'AgentsController@edit',
                        'as' => 'admin.agent.edit'
                ]);

                Route::post('agent/update/{city_id}', [
                        'uses' => 'AgentsController@update',
                        'as' => 'admin.agent.update'
                ]);

                Route::get('invoices/balance', [
                        'uses' => 'InvoicesController@balance',
                        'as' => 'admin.shop.balance'
                ]);

                /*Партнерка*/
                Route::get('partnership-list', [
                        'uses' => 'ShopsController@partnershipList',
                        'as' => 'shops.partnership.list'
                ]);

                Route::post('order/charge/{order_id}', [
                        'uses' => 'OrdersController@charge',
                        'as' => 'admin.order.charge'
                ]);

                Route::get('articles', [
                        'uses' => 'ArticleController@index',
                        'as' => 'admin.articles'
                ]);

                Route::get('article/create', [
                        'uses' => 'ArticleController@create',
                        'as' => 'admin.article.create'
                ]);

                Route::get('article/edit/{id}', [
                        'uses' => 'ArticleController@edit',
                        'as' => 'admin.article.edit'
                ]);

                Route::post('article/store', [
                        'uses' => 'ArticleController@store',
                        'as' => 'admin.article.store'
                ]);

                Route::post('article/update/{id}', [
                        'uses' => 'ArticleController@update',
                        'as' => 'admin.article.update'
                ]);

                Route::get('article/destroy/{id}', [
                        'uses' => 'ArticleController@destroy',
                        'as' => 'admin.article.destroy'
                ]);


                //Articles Category

                Route::get('article-categories', [
                        'uses' => 'ArticleCategoryController@index',
                        'as' => 'admin.article-categories'
                ]);

                Route::get('article-category/create', [
                        'uses' => 'ArticleCategoryController@create',
                        'as' => 'admin.article-category.create'
                ]);

                Route::get('article-category/edit/{id}', [
                        'uses' => 'ArticleCategoryController@edit',
                        'as' => 'admin.article-category.edit'
                ]);

                Route::post('article-category/store', [
                        'uses' => 'ArticleCategoryController@store',
                        'as' => 'admin.article-category.store'
                ]);

                Route::post('article-category/update/{id}', [
                        'uses' => 'ArticleCategoryController@update',
                        'as' => 'admin.article-category.update'
                ]);

                Route::get('article-category/destroy/{id}', [
                        'uses' => 'ArticleCategoryController@destroy',
                        'as' => 'admin.article-category.destroy'
                ]);

                //Articles Category END


                Route::get('promoTexts', [
                        'uses' => 'PromoTextController@index',
                        'as' => 'admin.promo_texts'
                ]);

                Route::get('promoText/create', [
                        'uses' => 'PromoTextController@create',
                        'as' => 'admin.promo_text.create'
                ]);

                Route::get('promoText/edit/{id}', [
                        'uses' => 'PromoTextController@edit',
                        'as' => 'admin.promo_text.edit'
                ]);

                Route::post('promoText/store', [
                        'uses' => 'PromoTextController@store',
                        'as' => 'admin.promo_text.store'
                ]);

                Route::post('promoText/update/{id}', [
                        'uses' => 'PromoTextController@update',
                        'as' => 'admin.promo_text.update'
                ]);

                Route::get('promoText/destroy/{id}', [
                        'uses' => 'PromoTextController@destroy',
                        'as' => 'admin.promo_text.destroy'
                ]);

                Route::get('invoices', [
                        'uses' => 'InvoicesController@index',
                        'as' => 'admin.invoices'
                ]);

                Route::get('invoices2', [
                        'uses' => 'InvoicesController@index2',
                        'as' => 'admin.invoices2'
                ]);

                Route::post('invoices/changeStatus/{id}', [
                        'uses' => 'InvoicesController@changeStatus',
                        'as' => 'admin.changeStatus'
                ]);

                Route::get('singleStat', [
                        'uses' => 'ProductsController@singleStat',
                        'as' => 'admin.product.single-stat'
                ]);

                Route::get('setting', [
                        'uses' => 'SettingController@index',
                        'as' => 'admin.setting.index'
                ]);

                Route::post('setting', [
                        'uses' => 'SettingController@store',
                        'as' => 'admin.setting.store'
                ]);

                Route::get('feedback', [
                        'uses' => 'FeedbackController@index',
                        'as' => 'admin.feedback.list'
                ]);

                Route::get('feedback/real', [
                        'uses' => 'FeedbackController@real',
                        'as' => 'admin.feedback.real.list'
                ]);

                Route::get('feedback/create', [
                        'uses' => 'FeedbackController@create',
                        'as' => 'admin.feedback.create'
                ]);

                Route::get('feedback/edit/{id}', [
                        'uses' => 'FeedbackController@edit',
                        'as' => 'admin.feedback.edit'
                ]);

                Route::get('feedback/shop_products', [
                        'uses' => 'FeedbackController@shop_products',
                        'as' => 'admin.feedback.shop_products'
                ]);

                Route::post('feedback/store', [
                        'uses' => 'FeedbackController@store',
                        'as' => 'admin.feedback.store'
                ]);

                Route::post('feedback/update/{id}', [
                        'uses' => 'FeedbackController@update',
                        'as' => 'admin.feedback.update'
                ]);

                Route::get('feedback/destroy/{id}', [
                        'uses' => 'FeedbackController@destroy',
                        'as' => 'admin.feedback.destroy'
                ]);

                Route::get('feedback/unapprove/{id}', [
                        'uses' => 'FeedbackController@unapprove',
                        'as' => 'admin.feedback.unapprove'
                ]);

                Route::get('feedback/approve/{id}', [
                        'uses' => 'FeedbackController@approve',
                        'as' => 'admin.feedback.approve'
                ]);

                Route::get('promoCodes/create', [
                        'uses' => 'PromoCodesController@create',
                        'as' => 'admin.promoCodes.create'
                ]);

                Route::post('promoCodes/store', [
                        'uses' => 'PromoCodesController@store',
                        'as' => 'admin.promoCodes.store'
                ]);

                Route::post('promoCodes/delete/{id}', [
                        'uses' => 'PromoCodesController@destroy',
                        'as' => 'admin.promoCodes.delete'
                ]);

                Route::get('shops', [
                        'uses' => 'ShopsController@shops',
                        'as' => 'admin.shop.list'
                ]);

                Route::get('shop/{id}', [
                        'uses' => 'ShopsController@profile',
                        'as' => 'admin.shop.profile_edit'
                ]);

                Route::post('shop/sendProductEmail/{shop_id}', [
                        'uses' => 'ShopsController@sendProductEmail',
                        'as' => 'admin.shop.sendProductEmail'
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

                Route::group(['prefix' => 'api/v1'], function() {
                        Route::post('product/toDop/{id}', [
                                'uses' => 'ProductsController@apiToDopProduct',
                                'as' => 'admin.api.product.apiToDopProduct'
                        ]);

                        Route::get('invoices', [
                                'uses' => 'InvoicesController@apiList',
                                'as' => 'admin.api.invoices.list'
                        ]);
                });

                Route::get('reports/list', [
                        'uses' => 'ReportsController@all',
                        'as' => 'admin.reports.list'
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

        Route::post('shop/getReport/{id}', [
                'uses' => 'ShopsController@getReport',
                'as' => 'admin.shop.getReport'
        ]);

        Route::get('report/getReportCmd', [
                'uses' => 'ShopsController@getReportCmd',
                'as' => 'admin.shop.getReportCmd'
        ]);

        Route::get('report/getReportFile/{id}', [
                'uses' => 'ShopsController@getReportFile',
                'as' => 'admin.shop.getReportFile'
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

        Route::get('products/dop', [
                'uses' => 'ProductsController@dopProducts',
                'as' => 'admin.dopProducts'
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

                Route::post('product/changeBlockProduct/{id}', [
                        'uses' => 'ProductsController@apiChangeBlockProduct',
                        'as' => 'admin.api.product.apiChangeBlockProduct'
                ]);

                Route::post('product/changePauseProduct/{id}', [
                        'uses' => 'ProductsController@apiChangePauseProduct',
                        'as' => 'admin.api.product.apiChangePauseProduct'
                ]);

                Route::post('product/changeStarProduct/{id}', [
                        'uses' => 'ProductsController@apiChangeStarProduct',
                        'as' => 'admin.api.product.apiChangeStarProduct'
                ]);

                Route::post('product/rotatePhoto/{id}', [
                        'uses' => 'ProductsController@rotatePhoto',
                        'as' => 'admin.api.product.rotatePhoto'
                ]);

                /* ORDERS*/
                Route::get('orders', [
                        'uses' => 'OrdersController@apiList',
                        'as' => 'admin.api.orders.list'
                ]);

                Route::get('product/{id}', [
                        'uses' => 'ProductsController@apiProduct',
                        'as' => 'admin.api.product.product'
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

Route::get('/recover/reset', [
        'uses' => 'Auth\SendsPasswordResetEmailsController@showLinkRequestForm',
        'as' => 'recover.reset'
]);

Route::post('/recover/email', [
        'uses' => 'Auth\SendsPasswordResetEmailsController@sendResetLinkEmail',
        'as' => 'recover.email'
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

/*Articles*/

Route::get('/articles/{slug}', [
        'uses' => 'ArticleController@show',
        'as' => 'article.show'
]);

/*Sitemap*/
Route::get('/sitemap.xml', 'SitemapController@index');

Route::get('404', ['as' => '404', 'uses' => 'HomeController@notfound']);
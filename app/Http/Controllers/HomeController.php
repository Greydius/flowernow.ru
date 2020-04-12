<?php

namespace App\Http\Controllers;

use App\Model\Order;
use App\Model\OrderTransfer;
use App\Model\Shop;
use App\Model\Product;
use App\Model\CashVoucher;
use App\Model\Feedback;
use App\Model\Transaction;
use App\Model\ProductType;
use App\Model\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Dompdf\Dompdf;
use Dompdf\Options;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
            parent::__construct();
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function delivery()
    {
        return view('front.delivery');
    }

        public function notfound()
        {
                return view('errors.404');
        }

    public function payment()
    {
        return view('front.payment');
    }

    public function faq()
    {
        return view('front.faq');
    }
    
    public function registershop() {
            return view('front.registershop');
    }
    
    public function corporate() {
            $productTypes = ProductType::where('show_on_main', '1')->get();
            $city_id = $this->current_city->id;
            $lowPriceProducts = Product::randProducts($city_id)->take(9)->get();

            $popularProducts = [];
            $item = [];
            $request = new Request();

            foreach ($productTypes as $productType) {
                    $request->product_type = $productType->slug;
                    $item['productType'] = $productType;
                    $item['popularProduct'] = Product::popular($this->current_city->id, $request, 1, $productType->id == 2 ? 6 : 8);
                    $item['popularProductCount'] = count($item['popularProduct']);
                    if($item['popularProductCount']) {
                            $popularProducts[] = $item;
                    }
            }

            if(!empty($this->user) && $this->user->admin) {
                    //dd($popularProducts);
            }

            unset($request->product_type);

            return view('front.corporate', [
                    'lowPriceProducts' => $lowPriceProducts,
                    'popularProducts' => $popularProducts,
                    'pageTitle' => ('Доставка цветов для юр лиц по безналичному расчету в '.$this->current_city->name_prepositional.' | Оплата с расчетного счета организации'),
                    'pageDescription' => ('Доставка цветов и букетов для юр лиц в '.$this->current_city->name_prepositional.' по безналичному расчету. Федеральная курьерская служба доставки букетов цветов. Оплата с расчетного счета организации. Бесплатная круглосуточная доставка! Заказать цветы онлайн от 900 ₽'),
                    'pageKeywords' => ('доставка, цветы, юридическое лицо, безнал, расчетный счет, '.$this->current_city->name.', область, заказать, онлайн, круглосуточно, бесплатная, на дом, в офис, интернет, магазин, растения, россии, букеты'),
            ]);
    }

    public function agreement() {
            return view('front.agreement');
    }
    
    public function privacy() {
            return view('front.privacy');
    }

    public function personldata() {
            return view('front.personldata');
    }

    public function oferta() {
            return view('front.oferta');
    }

    public function terms() {
            return view('front.terms');
    }

    public function test(Request $request) {

            $orders = Order::where('payed', 1)->select('phone')->distinct()->get();

            foreach($orders as $key => $order) {
                    $message = new \App\Model\Message();
                    $message->message_type = 'sms';
                    $message->send_to = $order->phone;
                    $message->send_to = '+79119245792';
                    $message->msg = json_encode(['text' => 'Закажите букет на 14 февр с 5% скидкой код 5F14']);
                    $message->save();
                    exit();
            }

            /*
            $shops = Shop::where('id', '>', 12)->get();

            foreach($shops as $shop) {
                    $message = new \App\Model\Message();
                    $message->message_type = 'email';
                    $message->send_to = $shop->email;
                    //$message->send_to = 'nkornushin@gmail.com';
                    $message->msg = json_encode(['text' => view('email.shop14022020')->render(),
                            'subject' => '14 февраля скоро :)']);
                    $message->save();
            }

            exit();
            */
/*
            $shops = Shop::where('id', '>', 12)->get();

            foreach($shops as $shop) {
                    $message = new \App\Model\Message();
                    $message->message_type = 'email';
                    $message->send_to = $shop->email;
                    $message->msg = json_encode(['text' => view('email.flowwow')->render(),
                            'subject' => 'Floristum.ru и flowwow']);
                    $message->save();
            }

            exit();
*/

            /*
            $product = Product::where('id', 23498)->first();

            echo \App\Helpers\AppHelper::RESIZER('/uploads/products/'.$product->shop_id.'/'.$product->photo, 351, 351, 1, NULL, 75);
            exit();

            \App\Helpers\AppHelper::RESIZER();
            */

            $productTypes = ProductType::where('show_on_main', '1')->get();
            $banners = Banner::whereNotNull('checked_on')->with('shop')->get();
            $products = [];

            foreach($banners as $banner) {
                    foreach($productTypes as $productType) {
                            $request = new Request();
                            $request->shop_id = $banner->shop->id;
                            $request->productType = $productType->id;
                            $request->order = 'rand';
                            $_products = Product::popular($banner->shop->city_id, $request, 1, 1);
                            if($_products->total() > 0) {
                                    foreach($_products as $p) {
                                            $products[] = $p;
                                    }
                            }
                    }
            }

            foreach($products as $product) {
                    $product->sort = 199996320;
                    $product->save();
            }

            dd($products);

            exit();


            //$date = date('d').' '.\App\Helpers\AppHelper::ruMonth(date('m')).' '.date('Y').' г.';
            $date = \Carbon::now()->subMonth();
            $firstOrder = Order::where('shop_id', '254')->where('payed', 1)->where('payment', 'rs')->first();

            $view = view('reports.report', [
                    'date' => $date,
                    'firstOrder' => $firstOrder,
                    'orders' => Order::where('shop_id', '254')->where('payed_at', '>=', $date->startOfMonth()->format('Y-m-d 00:00:00'))->where('payed_at', '<=', $date->endOfMonth()->format('Y-m-d 23:59:59'))->get(),
                    'shop' => Shop::find(254)
                    //'header' => 'Счет на оплату № '.$order->id.' от '.$date,
                    //'order' => $order
            ])->render();


            header("Content-type: application/vnd.ms-word");
            header("Content-Disposition: attachment;Filename=qwe.doc");
            header("Pragma: no-cache");
            header("Expires: 0");

            echo $view;

            exit();


            $tags = "<br>";
            $test = strip_tags($tags,$view);
            dd($test);
            $breaks = array("<br />","<br>","<br/>");
            $text = str_ireplace($breaks, "\r\n", $test);


            $pw = new \PhpOffice\PhpWord\PhpWord();

            /* [THE HTML] */
            $section = $pw->addSection();
            $html = "<h1>HELLO WORLD!</h1>";
            $html .= "<p>This is a paragraph of random text</p>";
            $html .= "<table><tr><td>A table</td><td>Cell</td></tr></table>";
            \PhpOffice\PhpWord\Shared\Html::addHtml($section, $text, false, false);

            /* [SAVE FILE ON THE SERVER] */
// $pw->save("html-to-doc.docx", "Word2007");

            /* [OR FORCE DOWNLOAD] */
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment;filename="convert.docx"');
            $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($pw, 'Word2007');
            $objWriter->save('php://output');

            exit();


            $dompdf = new Dompdf();
            $dompdf->set_option('isRemoteEnabled', true);
            $dompdf->set_option('isHtml5ParserEnabled', true);

            //$date = date('d').' '.\App\Helpers\AppHelper::ruMonth(date('m')).' '.date('Y').' г.';
            $date = \Carbon::now()->subMonth();
            $firstOrder = Order::where('shop_id', '254')->where('payed', 1)->where('payment', 'rs')->first();

            $view = view('reports.report', [
                    'date' => $date,
                    'firstOrder' => $firstOrder,
                    'orders' => Order::where('shop_id', '254')->where('payed_at', '>=', $date->startOfMonth()->format('Y-m-d 00:00:00'))->where('payed_at', '<=', $date->endOfMonth()->format('Y-m-d 23:59:59'))->get(),
                    'shop' => Shop::find(254)
                    //'header' => 'Счет на оплату № '.$order->id.' от '.$date,
                    //'order' => $order
            ])->render();

            //echo $view; exit();

            $dompdf->loadHtml($view, 'UTF-8');

            // (Optional) Setup the paper size and orientation
            //$dompdf->setPaper('A4', 'landscape');

            // Render the HTML as PDF
            $dompdf->render();

            // Output the generated PDF to Browser
            $dompdf->stream();


            exit();
            $orders = Order::where('created_at', '>', '2019-03-07')->where('payed', 1)->where('status', 'new')->where('payment', 'card')->select('shop_id')->distinct()->get();


            foreach($orders as $key => $order) {
                    $shop = Shop::find($order->shop_id);
                    if(!empty($shop->email)) {
                            $message = new \App\Model\Message();
                            $message->message_type = 'email';
                            $message->send_to = $shop->email;
                            $message->msg = json_encode(['text' => view('email.march8Reminder')->render(),
                                    'subject' => 'У Вас не принятые заказы от Floristum.ru']);
                            $message->save();
                    }
            }

            echo $key;

            exit();

            $order = Order::find(37031);

            $standartOrderLink = $order->getDetailsLink();

            dd($order->orderLists()->withTrashed()->get());

            echo $standartOrderLink; exit();

            $order->shop_id = 10;
            if($order->save()) {

                    $shop = $order->shop;

                    dd($shop);
            }
            echo $order->shop->id;

            exit();

            /*
            $orders = Order::where('payed', 1)->select('phone')->distinct()->get();

            foreach($orders as $key => $order) {
                    $message = new \App\Model\Message();
                    $message->message_type = 'sms';
                    $message->send_to = $order->phone;
                    $message->msg = json_encode(['text' => 'До 9 марта -5% на цветы с доставкой floristum.ru. Код:MR8']);
                    $message->save();
            }

            echo $key;

            exit();
            */
            

            /*
            $order = Order::where('id', 37884)->with('shop')->first();


            $shop = $order->shop;

            Mail::send('email.adminNewOrder', ['order' => $order, 'shop' => $shop], function ($message) use ($order) {
                    $message->to(['nkornushin@gmail.com'])
                            ->subject('Создан новый заказ для ЮР. ЛИЦА №'. $order->id);

                    if($order->invoicePath) {
                            $message->attach($order->invoicePath);
                    }
            });
            */


/*
            $shopId = 117;

            $shop = Shop::find($shopId);

            $products = Product::where('shop_id', $shop->id)->whereIn('status', [0, 3])->whereNull('single')->get();
            $totalProductsCount = Product::where('shop_id', $shop->id)->whereNull('single')->count();

            if($shop->email) {
                    try {
                            Mail::send('email.shopProductBan2', ['products' => $products, 'shop' => $shop, 'totalProductsCount' => $totalProductsCount], function ($message) use ($shop) {
                                    $message->to(['nkornushin@gmail.com'])
                                            ->subject('Уведомление для '.$shop->name.' на Floristum.ru');
                            });
                    } catch (\Exception $e) {
                            echo $e->getMessage();
                            \Log::debug('sendSuccessEmails - '.$e->getMessage());
                    }
            }

            echo $shop->email;

            exit();
*/


            $productTypes = ProductType::where('show_on_main', '1')->get();
            $banners = Banner::whereNotNull('checked_on')->with('shop')->get();
            $products = [];

            foreach($banners as $banner) {
                    foreach($productTypes as $productType) {
                            $request = new Request();
                            $request->shop_id = $banner->shop->id;
                            $request->productType = $productType->id;
                            $request->order = 'rand';
                            $_products = Product::popular($banner->shop->city_id, $request, 1, 1);
                            if($_products->total() > 0) {
                                    foreach($_products as $p) {
                                            $products[] = $p;
                                    }
                            }
                    }
            }

            foreach($products as $product) {
                    $product->sort = 199996320;
                    $product->save();
            }

            dd($products);

            exit();

            $path = public_path('uploads/single/');

            $files = scandir($path);

            foreach($files as $file) {
                    if(is_file($path.$file)) {

                            $newFileName = $path.'632x632/'.$file;
                            \Image::make($path.$file)->fit(632, 632)->save( $newFileName );

                    }
            }

echo "finish";
            exit();

            $shopId = 117;

            $shop = Shop::find($shopId);

            $products = Product::where('shop_id', $shop->id)->whereIn('status', [0, 3])->whereNull('single')->get();
            $totalProductsCount = Product::where('shop_id', $shop->id)->whereNull('single')->count();

            if($shop->email) {
                    try {
                            Mail::send('email.shopProductBan2', ['products' => $products, 'shop' => $shop, 'totalProductsCount' => $totalProductsCount], function ($message) use ($shop) {
                                    $message->to(['nkornushin@gmail.com'])
                                            ->subject('Уведомление для '.$shop->name.' на Floristum.ru');
                            });
                    } catch (\Exception $e) {
                            \Log::debug('sendSuccessEmails - '.$e->getMessage());
                    }
            }

            exit();


            $shopId = 788888;

            try {
                    $shop = Shop::where('id', $shopId)->firstOrFail();
            } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $ex) {
                    \Log::debug('View order: '.$shopId);
                    throw new \Illuminate\Database\Eloquent\ModelNotFoundException();
            }

            exit();

            /*
             *
             * [2018-11-30 09:35:31] local.ERROR: Operation timed out after 30553 milliseconds with 0 out of 0 bytes received {"exception":"[object] (Platron\\Atol\\SdkException(code: 28): Operation timed out after 30553 milliseconds with 0 out of 0 bytes received at /home/m/mihast6k/flowenow.ru/vendor/payprocessing/atol-online/src/clients/PostClient.php:68)
[stacktrace]
#0 /home/m/mihast6k/flowenow.ru/app/Console/Commands/GenerateCashVoucher.php(51): Platron\\Atol\\clients\\PostClient->sendRequest(Object(Platron\\Atol\\services\\GetTokenRequest))
#1 [internal function]: App\\Console\\Commands\\GenerateCashVoucher->handle()
#2 /home/m/mihast6k/flowenow.ru/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(29): call_user_func_array(Array, Array)
#3 /home/m/mihast6k/flowenow.ru/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(87): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()
#4 /home/m/mihast6k/flowenow.ru/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(31): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))
#5 /home/m/mihast6k/flowenow.ru/vendor/laravel/framework/src/Illuminate/Container/Container.php(549): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)
#6 /home/m/mihast6k/flowenow.ru/vendor/laravel/framework/src/Illuminate/Console/Command.php(183): Illuminate\\Container\\Container->call(Array)
#7 /home/m/mihast6k/flowenow.ru/vendor/symfony/console/Command/Command.php(252): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))
#8 /home/m/mihast6k/flowenow.ru/vendor/laravel/framework/src/Illuminate/Console/Command.php(170): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))
#9 /home/m/mihast6k/flowenow.ru/vendor/symfony/console/Application.php(938): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))
#10 /home/m/mihast6k/flowenow.ru/vendor/symfony/console/Application.php(240): Symfony\\Component\\Console\\Application->doRunCommand(Object(App\\Console\\Commands\\GenerateCashVoucher), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))
#11 /home/m/mihast6k/flowenow.ru/vendor/symfony/console/Application.php(148): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))
#12 /home/m/mihast6k/flowenow.ru/vendor/laravel/framework/src/Illuminate/Console/Application.php(88): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))
#13 /home/m/mihast6k/flowenow.ru/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(121): Illuminate\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))
#14 /home/m/mihast6k/flowenow.ru/artisan(37): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))
#15 {main}
"} 
             */

            \Log::debug('An informational message.');

            exit();


            //$shopId = 165;
            $shopId = 117;



            $orders = Order::where('shop_id', $shopId)->where('status', 'completed')->get();

            $sum = 0;
            $i=1;
            foreach($orders as $order) {
                    $s = $order->amountShop();
                    $sum += $s;
            }

            echo '<br><br><br><br>';
            echo $sum;
            

            exit();

            $shop_id = 351;


            $shop = Shop::find($shop_id);

            $products = Product::where('shop_id', $shop->id)->whereIn('status', [0, 3])->whereNull('single')->get();
            $totalProductsCount = Product::where('shop_id', $shop->id)->whereNull('single')->count();

            if($shop->email) {
                    Mail::send('email.shopProductBan2', ['products' => $products, 'shop' => $shop, 'totalProductsCount' => $totalProductsCount], function ($message) use ($shop) {
                            $message->to(['nkornushin@gmail.com'])
                                    ->subject('Уведомление для '.$shop->name.' на Floristum.ru');
                    });
            }

            return response()->json([], 200);
            exit();

            //$products = Shop::find(397)->products()->where('status_comment_at', '>', \Carbon::now()->subDays(10))->get();
            $shop = Shop::find(351);



            $products = Product::where('shop_id', $shop->id)->whereIn('status', [0, 3])->whereNull('single')->get();
            $totalProductsCount = Product::where('shop_id', $shop->id)->whereNull('single')->count();



            Mail::send('email.shopProductBan', ['products' => $products,], function ($message) use ($products) {
                    $message->to(['nkornushin@gmail.com', 'a.elcheninov@mail.ru', 'service@Floristum.ru'])
                            ->subject('Внимание от Floristum.ru');
            });




            return view('email.shopProductBan2',[
                    'products' => $products,
                    'shop' => $shop,
                    'totalProductsCount' => $totalProductsCount
            ]);


            exit();

            $client = new \Platron\Atol\clients\PostClient();

            $tokenService = new \Platron\Atol\services\GetTokenRequest('floristum-ru', '6iabjyA0K');
            $tokenResponse = new \Platron\Atol\services\GetTokenResponse($client->sendRequest($tokenService));


            //$getStatusService = new \Platron\Atol\services\GetStatusRequest('floristum-ru_8783', '89607369-7854-4ec5-8e89-34299fced39a', $tokenResponse->token);
            $getStatusService = new \Platron\Atol\services\GetStatusRequest('floristum-ru_8783', '0cea1763-03e8-4ef5-a2e9-2ff2a091edd1', $tokenResponse->token);
            $getStatusResponse = new \Platron\Atol\services\GetStatusResponse($client->sendRequest($getStatusService));

            print_r($getStatusResponse); exit();


            //$orders = Order::with(['orderLists.product'])->where('id', '=', '37389')->where('payment', Order::$PAYMENT_CARD)->where('payed', 1)->doesntHave('cashVouchers')->get();
            $orders = Order::with(['orderLists.product'])->where('id', '=', '37394')->get();

            $client = new \Platron\Atol\clients\PostClient();

            $tokenService = new \Platron\Atol\services\GetTokenRequest('floristum-ru', '6iabjyA0K');
            $tokenResponse = new \Platron\Atol\services\GetTokenResponse($client->sendRequest($tokenService));
            

            foreach($orders as $order) {
                    
                    $createDocumentService = (new \Platron\Atol\services\CreateDocumentRequest($tokenResponse->token));
                    $i = 0;
                    foreach($order->orderLists as $orderList) {
                            $receiptPosition = new \Platron\Atol\data_objects\ReceiptPosition($orderList->product->name.($orderList->single ? ' ('.$orderList->qty.' шт.)' : ''), $orderList->client_price + ($i == 0 ? ($orderList->single ? $order->delivery_price : 0) + ($order->delivery_out_distance ? $order->delivery_out_distance*$order->delivery_out_price : 0) : 0), 1, \Platron\Atol\data_objects\ReceiptPosition::TAX_NONE);
                            $createDocumentService->addReceiptPosition($receiptPosition);
                            $i++;
                    }

                    $createDocumentService->addCustomerEmail('nkornushin@gmail.com')
                            ->addCustomerPhone('79803888394')
                            ->addGroupCode('floristum-ru_8783')
                            ->addInn('7807189999')
                            ->addCompanyEmail('info@floristum.ru')
                            ->addMerchantAddress('https://floristum.ru/')
                            ->addOperationType(\Platron\Atol\services\CreateDocumentRequest::OPERATION_TYPE_SELL)
                            ->addPaymentType(\Platron\Atol\services\CreateDocumentRequest::PAYMENT_TYPE_ELECTRON)
                            ->addSno(\Platron\Atol\services\CreateDocumentRequest::SNO_USN_INCOME_OUTCOME)
                            ->addExternalId($order->id);

                    $createDocumentResponse = new \Platron\Atol\services\CreateDocumentResponse($client->sendRequest($createDocumentService));


                    $cashVoucher = new CashVoucher();
                    $cashVoucher->order_id = $order->id;
                    $cashVoucher->uuid = $createDocumentResponse->uuid;
                    $cashVoucher->save();

                    print_r($createDocumentResponse);
                    exit();


            }




            exit();

            $client = new \Platron\Atol\clients\PostClient();

            $tokenService = new \Platron\Atol\services\GetTokenRequest('floristum-ru', '6iabjyA0K');
            $tokenResponse = new \Platron\Atol\services\GetTokenResponse($client->sendRequest($tokenService));


            //$getStatusService = new \Platron\Atol\services\GetStatusRequest('floristum-ru_8783', '89607369-7854-4ec5-8e89-34299fced39a', $tokenResponse->token);
            $getStatusService = new \Platron\Atol\services\GetStatusRequest('floristum-ru_8783', '0303c126-264e-40c6-8558-a732e4255c28', $tokenResponse->token);
            $getStatusResponse = new \Platron\Atol\services\GetStatusResponse($client->sendRequest($getStatusService));

            print_r($getStatusResponse); exit();



            $client = new \Platron\Atol\clients\PostClient();
            $receiptPosition = new \Platron\Atol\data_objects\ReceiptPosition('TestOff', 1.00, 1, \Platron\Atol\data_objects\ReceiptPosition::TAX_NONE);

            $createDocumentService = (new \Platron\Atol\services\CreateDocumentRequest($tokenResponse->token))
                    ->addCustomerEmail('nkornushin@gmail.com')
                    ->addCustomerPhone('79803888394')
                    ->addGroupCode('floristum-ru_8783')
                    ->addInn('7807189999')
                    ->addCompanyEmail('info@floristum.ru')
                    ->addMerchantAddress('https://floristum.ru/')
                    ->addOperationType(\Platron\Atol\services\CreateDocumentRequest::OPERATION_TYPE_SELL)
                    ->addPaymentType(\Platron\Atol\services\CreateDocumentRequest::PAYMENT_TYPE_ELECTRON)
                    ->addSno(\Platron\Atol\services\CreateDocumentRequest::SNO_USN_INCOME_OUTCOME)
                    ->addExternalId(3005)
                    ->addReceiptPosition($receiptPosition);
            //print_r($createDocumentService->getParameters()); exit();

            $createDocumentResponse = new \Platron\Atol\services\CreateDocumentResponse($client->sendRequest($createDocumentService));



            print_r($createDocumentResponse);
            exit();

            exit();

            // reference the Dompdf namespace

            //$contents = \Storage::disk('local')->getDriver()->getAdapter()->applyPathPrefix('file.ff');

            //dd($contents);

            //\Storage::disk('local')->put('file.txt', 'Contents');
            //exit();

            $orderId = 37302;

            $order = Order::find($orderId);

            $order->generateInvoice();

            if($order->invoicePath) {
                    Mail::send('email.rsNewOrder', ['order' => $order,], function ($message) use ($order) {
                            $message->to(['nkornushin@gmail.com'])
                                    ->subject('Счет от Floristum.ru №' . $order->id)
                                    ->attach($order->invoicePath);
                    });
            }


            exit();

            /*
            Mail::send('email.rsNewOrder', ['order' => $order, ], function ($message) use ($order) {
                        $message->to('nkornushin@gmail.com')
                                ->subject('Счет от Floristum.ru №'. $order->id);
            });

            exit();
*/

            try {

                    throw new \Exception('Деление на ноль.');
                        // instantiate and use the dompdf class
                        $dompdf = new Dompdf();
                    $dompdf->set_option('isRemoteEnabled', true);
                    $dompdf->set_option('isHtml5ParserEnabled', true);

                        $date = date('d').' '.\App\Helpers\AppHelper::ruMonth(date('m')).' '.date('Y').' г.';

                        $view = view('invoices.invoice', [
                                'header' => 'Счет на оплату № '.$order->id.' от '.$date,
                                'order' => $order
                        ])->render();

                        //echo $view; exit();

                        $dompdf->loadHtml($view, 'UTF-8');

                        // (Optional) Setup the paper size and orientation
                        //$dompdf->setPaper('A4', 'landscape');

                        // Render the HTML as PDF
                        $dompdf->render();

                        // Output the generated PDF to Browser
                        //$dompdf->stream();

                    $fileName = 'invoice_'.$order->id.'.pdf';
                    $filePath = '/invoices/'.$fileName;

                    \Storage::disk('local')->put($filePath, $dompdf->output());

                    Mail::send('email.rsNewOrder', ['order' => $order, ], function ($message) use ($order, $filePath) {
                                $message->to(['nkornushin@gmail.com', 'finance@floristum.ru'])
                                        ->subject('Счет от Floristum.ru №'. $order->id)
                                        ->attach(\Storage::disk('local')->getDriver()->getAdapter()->applyPathPrefix($filePath));
                    });

            }  catch(\Exception $e){
                        \Log::error($e);
                        Mail::send('email.system.exception', ['msg' => $e->getMessage() ], function ($message) {
                                $message->to('nkornushin@gmail.com')
                                        ->subject('floristum.ru exception '.date('Y-m-d H:i:s'));
                        });
            }

exit();
            $location = \SypexGeo::get('213.87.150.43');

            dd($location);

            exit();

            $client = new \GuzzleHttp\Client();
            $res = $client->request('POST', 'https://api.cloudpayments.ru/orders/create', [
                    'auth' => [
                            \Config::get('cloudpayments.publicId'),
                            \Config::get('cloudpayments.pwd')
                    ],
                    'form_params' => [
                            //'Amount' => 100,
                            'Currency' => 'RUB',
                            'Description' => 'Тестовый счет',
                            'InvoiceId' => '32055-8',
                            'Email' => 'nkornushin@gmail.com',
                            'SendEmail' => 'true'
                    ]
            ]);

            //echo $res->getStatusCode();

            //echo $res->getHeaderLine('content-type');

            $decoded_traces=json_decode($res->getBody());

            echo $decoded_traces->Message;

            dd($decoded_traces);

            //$this->syncSingle();

            exit();

            
            $city_id=637640;

            $ids = [2, 23, 194, 40, 194, 84, 56, 16, 21, 70,
                        105, //красных тюльпанов
                        97, //красных гвоздик
                        116, //красных пионов
                        130, //разноцветных ирисов
                        //138, //белых калл
                        171, //белых фрезий
                        183, //белых гортензий
                        166 //белых анемонов
                        ];

             $_products = Product::with(['shop' => function ($query) {
                     $query->select(['id', 'name', 'delivery_price']);
             }])->join(\DB::raw('
                (SELECT MIN(p.id) AS id, p.single FROM products p  
                INNER JOIN shops ON shops.id = p.shop_id
                INNER JOIN 
                (SELECT products.single, MIN(products.price) AS min_price
                FROM products 
                INNER JOIN shops ON shops.id = products.shop_id
                WHERE shops.city_id = ' . (int)$city_id . '
                AND products.status = 1 
                AND products.pause = 0 
                AND products.price > 0 
                AND products.single IN (' . implode(',', $ids) . ')                
                GROUP BY single) AS single ON single.single = p.single AND single.min_price = p.price
                WHERE shops.city_id = ' . (int)$city_id . '
                AND p.status = 1 
                AND p.pause = 0 
                AND p.price > 0 
                AND p.single IN (' . implode(',', $ids) . ') GROUP BY p.single) AS single2
            '), function ($join) {
                     $join->on('products.id', '=', 'single2.id');
             })->whereHas('shop', function ($query) use ($city_id) {
                     $query->where('city_id', $city_id)->available();
             })->orderByRaw(\DB::raw("FIELD(products.single, ".implode(',', $ids).")"))->get();

             dd($_products); exit();

            $_products = Product::whereIn('id', function ($query) use ($city_id, $ids) {
                    $query->select(['id', 'single', \DB::raw("MIN(price)")])
                    ->from('products')
                    ->whereHas('shop', function($query) use ($city_id) {
                                $query->where('city_id', $city_id)->available();
                        })->where('price', '>', 0)
                        ->where('status', 1)
                        ->where('pause', 0)
                        ->whereIn('single', $ids);
            })->with(['shop' => function ($query) {
                    $query->select(['id', 'name', 'delivery_price']);
            }])->whereHas('shop', function($query) use ($city_id) {
                        $query->where('city_id', $city_id)->available();
            })->get();

            $_products = Product::with(['shop'  => function($query) {
                            $query->select(['id', 'name', 'delivery_price']);
                        }])->whereHas('shop', function($query) use ($city_id) {
                                $query->where('city_id', $city_id)->available();
                        })->where('price', '>', 0)
                        ->where('status', 1)
                        ->where('pause', 0)
                        ->whereIn('single', $ids)
                        ->orderBy('price')->get();

            exit();

            $shops = Shop::whereExists(function ($query) {
                        $query->select("products.id")
                              ->from('products')
                              ->whereRaw('products.shop_id = shops.id')->where('price', '>', 0)->where('status', 1);
                    })->where('active', 1)->get();

            foreach ($shops as $shop) {
                    $feedback = Feedback::where('shop_id', 1)->first();
                    $feedback->shop_id = $shop->id;
                    $feedback->save();
            }

            dd($shops);

            exit();

            echo config('settings.single_product_commission'); exit();

            \App\Model\SingleProduct::copyProductsToShop(10);

            /*

            $orders = \DB::select("SELECT id, custphone FROM `f_order` WHERE `custphone` != ''");

            foreach ($orders as $order) {
                    $sql = "UPDATE `f_order` SET phone_clean = '".\App\Helpers\AppHelper::cleantel($order->custphone)."' WHERE `id` = ".$order->id;
                    \DB::update($sql);
            }
            */

            exit();

            $orders = Order::where('status', 'completed')->where('payed', '1')->get();
            foreach ($orders as $order) {
                    echo $order->createTransaction().'<br>';
            }
            echo "ds";
            exit();
    }

    public function syncSingle() {
            $singleProducts = \App\Model\SingleProduct::whereNotNull('parent_id')->get();

            foreach ($singleProducts as $singleProduct) {
                    Product::where('single', $singleProduct->id)->update([
                            'name' => $singleProduct->name,
                            'description' => $singleProduct->description,
                            'photo' => $singleProduct->photo,
                            'width' => $singleProduct->width,
                            'height' => $singleProduct->height,
                            'color_id' => $singleProduct->color_id,
                            'product_type_id' => $singleProduct->product_type_id
                    ]);
            }
    }

    public function happyRecipients() {
            $perPage = 9;
            $orders = Order::with('orderLists.product')->whereNotNull('photo')->whereHas('shop', function ($query) {
                    $query->where('city_id', $this->current_city->id);
            })->paginate($perPage);

            return view('front.happy-recipients', [
                    'orders' => $orders
            ]);
    }
}

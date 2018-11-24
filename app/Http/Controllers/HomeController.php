<?php

namespace App\Http\Controllers;

use App\Model\Order;
use App\Model\Shop;
use App\Model\Product;
use App\Model\CashVoucher;
use App\Model\Feedback;
use App\Model\Transaction;
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
            $city_id = $this->current_city->id;
            $lowPriceProducts = Product::lowPriceProducts($city_id)->take(9)->get();
            return view('front.corporate', [
                    'lowPriceProducts' => $lowPriceProducts,
                    'pageTitle' => ('Доставка цветов для юр лиц по безналичному расчету в '.$this->current_city->name_prepositional.' | Оплата с расчетного счета организации'),
                    'pageDescription' => ('Доставка цветов и букетов для юр лиц в '.$this->current_city->name_prepositional.' по безналичному расчету. Федеральная курьерская служба доставки букетов цветов. Оплата с расчетного счета организации. Бесплатная круглосуточная доставка! Заказать цветы онлайн от 900 руб.'),
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


            $orderId = 37302;

            $order = Order::find($orderId);
            echo $order->orderLists[0]->product->name;
            

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
}

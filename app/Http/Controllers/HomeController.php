<?php

namespace App\Http\Controllers;

use App\Model\Order;
use App\Model\Shop;
use App\Model\Product;
use App\Model\Feedback;
use App\Model\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
            return view('front.corporate');
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

    public function test() {

            $order = Order::where('status', 'completed')->where('payed', '1')->first();

            Mail::send('email.clientNewOrder', ['order' => $order, ], function ($message) use ($order) {
                                $message->to(['nkornushin@gmail.com', 'n.n.kornushin@yandex.ru'])
                                        ->subject('Заказ №'. $order->id .' оплачен!');
                        });

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

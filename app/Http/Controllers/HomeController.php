<?php

namespace App\Http\Controllers;

use App\Model\Order;
use App\Model\Transaction;
use Illuminate\Http\Request;

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
}

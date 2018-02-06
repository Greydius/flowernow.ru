<?php

namespace App\Http\Controllers;

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
}

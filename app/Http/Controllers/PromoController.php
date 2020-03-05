<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Model\Shop;

/**
 * @group Promo
 */

class PromoController extends Controller
{
        public function index() {
                $shops = Shop::where('copy_id', '=', 350)->with('users')->get();
                return response()->view('front.promo', [
                        'shops' => $shops
                ]);
        }
}
<?php

namespace App\Http\Controllers;

use App\Model\Product;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    //

        function add($productId) {
                $product = Product::with('shop.city')->with('compositions.flower')->findOrFail($productId);

                return view('front.order.add',[
                        'product' => $product
                ]);
        }
}

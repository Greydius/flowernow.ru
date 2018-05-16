<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Product;

class SitemapController extends Controller
{
    //

        public function index(Request $request) {

                $popularProduct = Product::popular($this->current_city->id, $request, 1, 50000);
                
                $products = [];
                foreach ($popularProduct as $product) {
                        $item = new \stdClass;
                        $item->uri = $product->url;
                        $item->updated_at = $product->updated_at;

                        $products[] = $item;
                }
                
                return response()->view('front.sitemap.list', [
                        'items' => $products
                ])->header('Content-Type', 'text/xml');
        }
}

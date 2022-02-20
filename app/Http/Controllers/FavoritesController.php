<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Product;

class FavoritesController extends Controller
{
  public function index(Request $request) {
    $favorites = $request->cookie('favorites');

    if($favorites != '') {
      $favorites_ids = explode(",", $favorites);
      $products = Product::whereIn('id', $favorites_ids)->get();
    }else {
      $products = array();
    }
    return view('favorites', ['products' => $products, 'favorites' => $favorites]);
  }
}

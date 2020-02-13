<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Model\Product;

class ApiProductController extends Controller
{
  public function all(Request $request)
  {
    return Product::all();
  }
}
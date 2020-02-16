<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use App\Model\Block;
use App\Model\Color;
use App\Model\Shop;
use App\Model\Flower;
use App\Model\Price;
use App\Model\Feedback;
use App\Model\Product;
use App\Model\SingleProduct;
use App\Model\ProductType;
use App\Model\ProductPhoto;
use App\Model\Size;
use App\Model\FeedbackCity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Image;
use App\Model\SpecialOffer;

class ProductsController extends Controller
{

        public function apiAllProducts(Request $request) {

                $return = [
                        'statusCode' => 200,
                        'message' => ''
                ];

                try{
                        $products = Product::where('price', '>', 0)->get();
                        $return = [
                          'statusCode' => 200,
                          'message' => '',
                          'data' => $products
                        ];

                } catch (\Exception $e){
                        $return['statusCode'] = 400;
                        $return['message'] = $e->getMessage();
                }finally{
                        return response()->json($return, $return['statusCode']);
                }

        }
}

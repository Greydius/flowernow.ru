<?php

namespace App\Http\Controllers;

use App\Model\Color;
use App\Model\Flower;
use App\Model\Price;
use App\Model\Product;
use App\Model\ProductType;
use App\Model\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Image;

class ProductsController extends Controller
{
    //
        public function index() {

                $popularProduct = Product::popular($this->current_city->id);

                return view('front.index',[
                        'popularProduct' => $popularProduct,
                        'prices' => Price::all(),
                        'sizes' => Size::all(),
                        'productTypes' => ProductType::where('show_on_main', '1')->get(),
                        'colors' => Color::all(),
                        'flowers' => Flower::orderBy('popularity', 'desc')->limit(9)->get(),
                ]);
        }

        public function show($slug) {
                $product = Product::where('slug', $slug)->with('shop.city')->with('compositions.flower')->first();
                return view('front.product.show',[
                        'product' => $product
                ]);
        }

        public function products() {

                $times = \App\Helpers\Data::times();

                return view('admin.products.list', [
                        'productTypes' => ProductType::all(),
                        'colors' => Color::all(),
                        'flowers' => Flower::orderBy('popularity', 'desc')->get(),
                        'times' => $times
                ]);
        }

        public function upload(Request $request) {

                $photo = Input::all();

                $validator = Validator::make($photo, Product::$photoRules, Product::$photoRulesMessages);

                if ($validator->fails()) {

                    return response()->json([
                        'error' => true,
                        'message' => $validator->messages()->first(),
                        'code' => 400
                    ], 400);

                }

                $shop = $this->user->getShop();

                $photo = $photo['file'];

                $extension = $photo->getClientOriginalExtension();

                $filename = 'p'.$shop->id.'_'.time().'_'.rand(10000, 99999).'.'.$extension;
                $filePath = Product::$fileUrl.$shop->id.'/';
                $fullFileName = $filePath . $filename;

                if(!file_exists(public_path($filePath))) {
                        \File::makeDirectory(public_path($filePath));
                }

                Image::make($photo)->save( public_path($fullFileName ) );

                $filePath = Product::$fileUrl.'632x632/'.$shop->id.'/';
                $fullFileName = $filePath . $filename;

                if(!file_exists(public_path($filePath))) {
                        \File::makeDirectory(public_path($filePath));
                }

                Image::make($photo)->fit(632, 632)->save( public_path($fullFileName ) );

                $product = new Product();
                $product->name = Product::getNewProductName($shop->id);
                $product->slug = Product::getNewProductSlug($product->name);
                $product->photo = $filename;
                $product->shop_id = $shop->id;
                $product->save();

                return response()->json([
                    'error' => false,
                    'code'  => 200
                ], 200);

        }

        public function apiList() {

                $statusCode = 200;
                $response = [
                        'products' => []
                ];

                try{
                        if($this->user->admin) {
                                $response['products'] = Product::with('compositions.flower')->orderBy('id', 'desc')->get();
                        } else {
                                $response['products'] = $this->user->getShop()->products()->with('compositions.flower')->orderBy('id', 'desc')->get();
                        }

                } catch (\Exception $e){
                    $statusCode = 400;
                }finally{
                    return response()->json($response, $statusCode);
                }
        }

        public function update(Request $request) {

                $validator = Validator::make($request->all(), Product::$productRules, Product::$productRulesMessages);

                if ($validator->fails()) {

                    return response()->json([
                        'error' => true,
                        'message' => $validator->messages()->first(),
                        'code' => 400
                    ], 400);

                }

                $shop = $this->user->getShop();

                $product = Product::find($request->input('id'));

                if(empty($product) || (!$this->user->admin && $shop->id != $product->shop_id)) {
                        return response()->json([
                                'error' => true,
                                'message' => 'Ошибка!',
                                'code' => 400
                        ], 400);
                }

                if($request->input('name') != $product->name) {
                        $product->slug = Product::getNewProductSlug($request->input('name'));
                }

                $product->name = $request->input('name');
                $product->shop_id = $request->input('shop_id');
                $product->price = $request->input('price');
                $product->width = $request->input('width');
                $product->height = $request->input('height');
                $product->product_type_id = $request->input('product_type_id');
                $product->color_id = $request->input('color_id');
                $product->make_time = $request->input('make_time');
                $product->description = $request->input('description');

                $product->compositions()->delete();

                $compositions = $request->input('compositions');
                $newCompositions = [];

                if(!empty($compositions)) {
                        foreach ($compositions as $composition) {
                                if(!empty($composition['flower_id'])) {
                                        $newCompositions[] = [
                                                'flower_id' => $composition['flower_id'],
                                                'qty' => $composition['qty']
                                        ];
                                }
                        }

                        $product->compositions()->createMany($newCompositions);
                }

                if($product->save()) {
                        return response()->json([
                            'error' => false,
                            'code'  => 200
                        ], 200);
                }

                return response()->json([
                        'error' => true,
                        'message' => 'Ошибка!',
                        'code' => 400
                ], 400);

        }
}

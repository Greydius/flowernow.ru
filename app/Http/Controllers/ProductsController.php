<?php

namespace App\Http\Controllers;

use App\Model\Color;
use App\Model\Flower;
use App\Model\Price;
use App\Model\Product;
use App\Model\ProductType;
use App\Model\ProductPhoto;
use App\Model\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Image;

class ProductsController extends Controller
{
    //
        public function index(Request $request) {

                $productTypes = ProductType::where('show_on_main', '1')->get();
                $currentType = null;

                $popularProducts = [];
                $popularProduct = [];

                if(empty($request->product_type)) {
                        $item = [];
                        foreach ($productTypes as $productType) {
                                $request->product_type = $productType->slug;
                                $item['productType'] = $productType;
                                $item['popularProduct'] = Product::popular($this->current_city->id, $request, 1, 6);
                                $item['popularProductCount'] = count($item['popularProduct']);
                                $popularProducts[] = $item;
                        }
                } else {
                        $popularProduct = Product::popular($this->current_city->id, $request, $request->page ? $request->page : 1, 36);
                        $currentType = ProductType::where('slug', $request->product_type)->first();
                }

                return view('front.index',[
                        'popularProduct' => $popularProduct,
                        'popularProducts' => $popularProducts,
                        'prices' => Price::all(),
                        'sizes' => Size::all(),
                        'productTypes' => $productTypes,
                        'currentType' => $currentType,
                        'colors' => Color::all(),
                        'flowers' => Flower::orderBy('popularity', 'desc')->limit(9)->get(),
                ]);
        }

        public function show($slug) {
                $product = Product::where('slug', $slug)->with('shop.city')->with('compositions.flower')->firstOrFail();
                return view('front.product.show',[
                        'product' => $product,
                        'pageImage' => $product->photoUrl,
                        'pageTitle' => 'Доставка '.$product->name.' в г '.$product->shop->city->name.' - Заказ цветов',
                        'pageDescription' => 'Заказ доставки '.$product->name.' в г '.$product->shop->city->name.': цветы в офис, на дом, другой город.',
                        'pageKeywords' => $product->name.', букет, цветы, доставка, заказ, '.$product->shop->city->name,
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

        public function products2() {

                $times = \App\Helpers\Data::times();

                return view('admin.products.list2', [
                        'productTypes' => ProductType::all(),
                        'colors' => Color::all(),
                        'flowers' => Flower::orderBy('popularity', 'desc')->get(),
                        'times' => $times
                ]);
        }

        public function uploadPhoto($id, Request $request) {
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

                if($this->user->admin) {
                        $product = Product::find($id);
                } else {
                        $product = $shop->products()->find($id);
                }

                if(!empty($product)) {

                        $shop_id = $product->shop_id;

                        $extension = $photo->getClientOriginalExtension();

                        $filename = 'p'.$shop_id.'_'.time().'_'.rand(10000, 99999).'.'.$extension;
                        $filePath = Product::$fileUrl.$shop_id.'/';
                        $fullFileName = $filePath . $filename;

                        if(!file_exists(public_path($filePath))) {
                                \File::makeDirectory(public_path($filePath));
                        }

                        Image::make($photo)->save( public_path($fullFileName ) );

                        $filePath = Product::$fileUrl.'632x632/'.$shop_id.'/';
                        $fullFileName = $filePath . $filename;

                        if(!file_exists(public_path($filePath))) {
                                \File::makeDirectory(public_path($filePath));
                        }

                        Image::make($photo)->fit(632, 632)->save( public_path($fullFileName ) );

                        $productPhoto = new ProductPhoto();
                        $productPhoto->product_id = $id;
                        $productPhoto->photo = $filename;
                        $productPhoto->save();

                        return response()->json([
                            'error' => false,
                            'photo' => ['photo' => $productPhoto->photo, 'id' => $productPhoto->id, 'product_id' => $productPhoto->product_id, 'priority' => ProductPhoto::where('product_id', $productPhoto->product_id)->count()],
                            'id' => $id,
                            'code'  => 200
                        ], 200);
                }

                return response()->json([
                        'error' => true,
                        'message' => 'Товар не найден',
                        'code' => 400
                ], 400);
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
                                $response['products'] = Product::with('compositions.flower')->with('photos')->with('shop')->orderBy('id', 'desc')->get();
                                //$products = Product::with('compositions.flower')->with('shop')->orderBy('id', 'desc')->paginate(15);
                                //dd($products->links());
                        } else {
                                $response['products'] = $this->user->getShop()->products()->with('compositions.flower')->with('photos')->orderBy('id', 'desc')->get();
                        }

                } catch (\Exception $e){
                    $statusCode = 400;
                }finally{
                    return response()->json($response, $statusCode);
                }
        }

        public function apiProductDelete($id) {

                $statusCode = 200;
                $message = '';

                try{
                        if($this->user->admin) {
                                $product = Product::find($id);
                        } else {
                                $product = $this->user->getShop()->products()->where('id', $id)->first();
                        }

                        if(empty($product)) {
                                throw new \Exception('Продукт не найден');
                        } else {
                                $product->delete();
                        }

                } catch (\Exception $e){
                        $statusCode = 400;
                        $message = $e->getMessage();
                }finally{
                        return response()->json([
                                'message' => $message,
                                'code' => $statusCode
                        ], $statusCode);
                }
        }

        public function apiChangePriority($id, Request $request) {

                $return = [
                        'statusCode' => 200,
                        'message' => ''
                ];

                try{
                        if($this->user->admin) {
                                $product = Product::with('photos')->find($id);
                        } else {
                                $product = $this->user->getShop()->products()->with('photos')->where('id', $id)->first();
                        }

                        if(empty($product)) {
                                throw new \Exception('Продукт не найден');
                        } else {
                                if(!empty($request->priority)) {
                                        $i = 0;
                                        foreach ($request->priority as $value) {
                                                $photo = $product->photos()->find($value);
                                                if(!empty($photo)) {
                                                        $photo->priority = $i;
                                                        if($photo->save() && $i == 0 && $photo->photo) {
                                                                $product->photo = $photo->photo;
                                                                $product->save();
                                                        }
                                                        $i++;
                                                }
                                        }
                                }
                        }

                        $return['photos'] = $product->photos()->get();

                } catch (\Exception $e){
                        $return['statusCode'] = 400;
                        $return['message'] = $e->getMessage();
                }finally{
                        return response()->json($return, $return['statusCode']);
                }

        }

        public function apiDeletePhoto($id, Request $request) {

                $return = [
                        'statusCode' => 200,
                        'message' => ''
                ];

                try{
                        if($this->user->admin) {
                                $photo = ProductPhoto::find($id);
                        } else {
                                $shop_id = $this->user->getShop()->id;
                                $photo = ProductPhoto::with('product')->whereHas('product', function($query) use ($shop_id) {
                                        $query->where('shop_id', $shop_id);
                                })->where('id', $id)->first();
                        }

                        if(empty($photo)) {
                                throw new \Exception('Фото не найдено');
                        } else {

                                if(ProductPhoto::where('product_id', $photo->product_id)->count() > 1) {
                                        $photo->delete();

                                        $photos = ProductPhoto::where('product_id', $photo->product_id)->get();

                                        if(!empty($photos)) {
                                                $i = 0;
                                                foreach ($photos as $photo) {
                                                        $photo->priority = $i;
                                                        $photo->save();
                                                        $i++;
                                                }
                                        }
                                }
                        }

                        $return['photos'] = ProductPhoto::where('product_id', $photo->product_id)->get();

                } catch (\Exception $e){
                        $return['statusCode'] = 400;
                        $return['message'] = $e->getMessage();
                }finally{
                        return response()->json($return, $return['statusCode']);
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

                if (!empty($compositions)) {
                        foreach ($compositions as $composition) {
                                if (!empty($composition['flower_id'])) {
                                        if (!empty($composition['qty'])) {
                                                $newCompositions[] = [
                                                        'flower_id' => $composition['flower_id'],
                                                        'qty' => $composition['qty']
                                                ];
                                        } else {
                                                return response()->json([
                                                        'error' => true,
                                                        'message' => 'Не указано кол-во в составе',
                                                        'code' => 400
                                                ], 400);
                                        }
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

        public function apiPopular(Request $request) {
                $statusCode = 200;
                $response = [
                        'products' => []
                ];

                try{
                        $response['products'] = Product::popular($this->current_city->id, $request, (!empty($request->page) ? $request->page : 1));
                } catch (\Exception $e){
                        $statusCode = 400;
                }finally{
                        return response()->json($response, $statusCode);
                }
        }
        
        public function filter($query = null, Request $request) {
                $queries = explode('/', $query);
                if(count($queries) == 2) {
                        $request->product_type = $queries[0];
                        if($queries[1] != 'vse-cvety') {
                                $flower = Flower::where('slug', $queries[1])->first();
                                if(count($flower)) {
                                        if(empty($request->flowers)) {
                                                $request->flowers = [];
                                        }
                                        $request->flowers = array_merge($request->flowers, [$flower->id]);
                                }
                        }
                        return $this->index($request);
                }

                return redirect()->route('front.index');
        }
}

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
use App\Model\SpecialOffer;

class ProductsController extends Controller
{
    //
        public function index(Request $request) {

                $viewFile = 'front.index';

                $title = '';
                $meta = [];

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
                                if($item['popularProductCount']) {
                                        $popularProducts[] = $item;
                                }
                        }

                        unset($request->product_type);
                } else {
                        $title = $this->getTitle($request);
                        $meta =  $this->getMeta($request);
                        $viewFile = 'front.product.list';
                        $popularProduct = Product::popular($this->current_city->id, $request, $request->page ? $request->page : 1, 36);
                        $currentType = ProductType::where('slug', $request->product_type)->first();
                }

                $specialOffers = \DB::table('special_offers')->whereRaw('? between date_from and date_to', [date('Y-m-d')])->get();

                $specialOfferProducts = [];

                if(!empty($specialOffers)) {
                        foreach ($specialOffers as $specialOffer) {
                                $city_id = $this->current_city->id;
                                $specialOfferProduct = Product::whereHas('shop', function($query) use ($city_id) {
                                        $query->where('city_id', $city_id)->where('active', 1)->where('delivery_price', '>', 0);
                                })->where('price', '>', 0)->where('status', 1)->where('pause', 0)->whereRaw('FIND_IN_SET(? ,special_offer_id)', [$specialOffer->id]);

                                if($specialOfferProduct->count()) {
                                        $specialOfferProducts[$specialOffer->id] = $specialOfferProduct->inRandomOrder()->take(9)->get();
                                }
                        }
                }

                $city_id = $this->current_city->id;
                $lowPriceProducts = Product::whereHas('shop', function($query) use ($city_id) {
                                $query->where('city_id', $city_id)->where('active', 1)->where('delivery_price', '>', 0);
                        })
                        ->where('price', '>', 0)
                        ->where('status', 1)
                        ->where('pause', 0)
                        ->whereNotIn('product_type_id', [7, 8, 9, 10])
                        ->orderByRaw('(price + (SELECT delivery_price FROM shops WHERE shops.id = products.shop_id))')->take(9)->get();


                if(!empty($this->user) && $this->user->admin) {
                        //dd($lowPriceProducts);
                }

                return view($viewFile,[
                        'title' => $title,
                        'meta' => $meta,
                        'popularProduct' => $popularProduct,
                        'popularProducts' => $popularProducts,
                        'lowPriceProducts' => $lowPriceProducts,
                        'prices' => Price::all(),
                        'sizes' => Size::all(),
                        'productTypes' => $productTypes,
                        'currentType' => $currentType,
                        'colors' => Color::all(),
                        'flowers' => Flower::orderBy('popularity', 'desc')->limit(9)->get(),
                        'specialOffers' => $specialOffers,
                        'specialOfferProducts' => $specialOfferProducts,
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
                        'productTypes' => ProductType::where('show_on_main', '1')->get(),
                        'colors' => Color::all(),
                        'specialOffers' => SpecialOffer::all(),
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

        public function apiList(Request $request) {

                $statusCode = 200;
                $response = [
                        'products' => []
                ];

                try{
                        $perPage = 16;
                        if($this->user->admin) {
                                $productRequestModel = Product::with(['compositions.flower', 'photos', 'shop'])->orderByRaw("status = 2 DESC, status = 0 DESC, status = 1 DESC, updated_at DESC");

                                if(!empty($request->search)) {
                                        $productRequestModel->orWhereHas('shop', function($query) use ($request) {
                                                $query->where('shops.name', 'like', "%$request->search%");
                                        });

                                        $productRequestModel->orWhereHas('shop.city', function($query) use ($request) {
                                                $query->where('cities.name', 'like', "%$request->search%");
                                        });
                                }
                        } else {
                                $productRequestModel = $this->user->getShop()->products()->with(['compositions.flower', 'photos'])->orderByRaw("status = 0 DESC, status = 3 DESC, status = 2 DESC, status = 1 DESC, id DESC");

                                if(!empty($request->search)) {
                                        $productRequestModel->orWhere('cities.name', 'like', "%$request->search%");
                                }
                        }

                        if(!empty($request->search)) {
                                $productRequestModel->orWhere('id', $request->search);
                        }

                        if(!empty((int)$request->status)) {
                                $productRequestModel->where('status', '!=', 1);
                        }

                        $response['products'] = $productRequestModel->paginate($perPage);

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

        public function apiChangeStatusProduct($id, Request $request) {

                $return = [
                        'statusCode' => 200,
                        'message' => ''
                ];

                try{
                        $product = null;

                        if($this->user->admin) {
                                $product = Product::find($id);
                        }

                        if(empty($product) || empty($request->status)) {
                                throw new \Exception('Продукт не найден');
                        } else {
                                if($request->status >= 1 && $request->status <= 3) {
                                        $product->status = $request->status;

                                        if($request->status == 3) {
                                                $product->status_comment = !empty($request->status_comment) ? $request->status_comment : null;
                                        }

                                        $product->save();
                                }
                        }

                } catch (\Exception $e){
                        $return['statusCode'] = 400;
                        $return['message'] = $e->getMessage();
                }finally{
                        return response()->json($return, $return['statusCode']);
                }

        }

        public function apiChangePauseProduct($id, Request $request) {

                $return = [
                        'statusCode' => 200,
                        'message' => ''
                ];

                try{
                        $product = Product::find($id);
                        $shop = $this->user->getShop();

                        if(empty($product) || !isset($request->pause) || (!$this->user->admin && $shop->id != $product->shop_id)) {
                                throw new \Exception('Продукт не найден');
                        } else {
                                $product->pause = (int)$request->pause ? 1 : 0;
                                $product->save();
                        }

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
                $product->special_offer_id = $request->input('special_offer_id');

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

                $updated_at = $product->updated_at;

                if($product->save()) {
                        if(!$this->user->admin && ($updated_at != $product->updated_at || $product->status == 0)) {
                                $product->status = 2;
                                $product->save();
                        }

                        return response()->json([
                                'error' => false,
                                'code' => 200,
                                'product' => $product
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
                        'title' => '',
                        'products' => []
                ];

                try{
                        $response['title'] = $this->getTitle($request);
                        $response['products'] = Product::popular($this->current_city->id, $request, (!empty($request->page) ? $request->page : 1));

                        $response['links'] = $request->server('HTTP_REFERER');

                        if(!$response['products']->total()) {
                                $productTypes = ProductType::where('show_on_main', '1')->get();
                                $item = [];
                                $popularProducts = [];
                                $_request = new Request();
                                foreach ($productTypes as $productType) {
                                        $_request->product_type = $productType->slug;
                                        $item['productType'] = $productType;
                                        //$item['popularProduct'] = Product::popular($this->current_city->id, $_request, 1, 6)->makeHidden(['price']);
                                        $result = Product::popular($this->current_city->id, $_request, 1, 6);
                                        $data = $result;
                                        $result = $result->makeHidden(['price']);
                                        $data->data = $result;

                                        $item['popularProduct'] = $data;

                                        $item['popularProductCount'] = count($item['popularProduct']);
                                        $popularProducts[] = $item;
                                }

                                if(!empty($popularProducts)) {
                                        $response['popularProducts'] = $popularProducts;
                                }

                                unset($_request->product_type);
                        }
                } catch (\Exception $e){
                        $statusCode = 400;
                }finally{
                        return response()->json($response, $statusCode);
                }
        }

        public function getTitle(Request $request) {
                $title = [];
                $title['type'] = 'Букеты и композиции';

                if(!empty($request->productType)) {
                        $productType = ProductType::find($request->productType);
                        if(!empty($productType)) {
                                $title['type'] = $productType->alt_name;
                        }
                } elseif(!empty($request->product_type)) {
                        $productType = ProductType::where('slug', $request->product_type)->first();
                        if(!empty($productType)) {
                                $title['type'] = $productType->alt_name;
                        }
                }

                //$title['color'] = null;
                if(!empty($request->color)) {
                        $color = Color::find($request->color);
                        if(!empty($color)) {
                                $title['color'] = 'цвет: '.mb_strtolower($color->name);
                        }
                }

                //$title['flowers'] = null;
                if(!empty($request->flowers) && is_array($request->flowers)) {
                        $flowers = Flower::whereIn('id', $request->flowers)->get();
                        if(!empty($flowers)) {
                                $flowersName = [];
                                foreach ($flowers as $flower) {
                                        $flowersName[] = mb_strtolower($flower->name);
                                }

                                if(!empty($flowersName)) {
                                        $title['flowers'] = 'с составом: '.implode(', ', $flowersName);
                                }
                        }
                }

                //$title['price'] = null;
                if(!empty($request->productPrice)) {
                        $price = Price::find($request->productPrice);
                        if(!empty($price)) {
                                $title['price'] = 'по цене '.mb_strtolower($price->name);
                        }
                } elseif(!empty($request->price_from) || !empty($request->price_to)) {
                        $title['price'] = 'по цене ';
                        if(!empty($request->price_from)) {
                                $title['price'] .= (int)$request->price_from >= 2000 ? ((int)$request->price_from + 1).' - ' : null;
                        }

                        if(!empty($request->price_to)) {
                                $title['price'] .= (int)$request->price_to < 9999999 ? ((int)$request->price_to == 1999 ? 'до ' : '') . ((int)$request->price_to + 1) : null;
                        }

                        $title['price'] .= ' руб';
                }

                return implode(', ', $title);
        }

        public function getMeta(Request $request) {

                $meta = [];


                $meta['title'] = 'Букеты и композиции';
                $meta['description'] = 'Заказать ';
                $meta['keywords'] = '';

                if(!empty($request->product_type)) {
                        $productType = ProductType::where('slug', $request->product_type)->first();
                        if(!empty($productType)) {
                                $meta['title'] = $productType->alt_name;
                        }
                }

                $meta['description'] .= mb_strtolower($meta['title']);
                $meta['description'] .= ' в г '.$this->current_city->name.' с доставкой';

                $meta['keywords'] .= mb_strtolower($meta['title']);
                
                if(!empty($request->flowers) && is_array($request->flowers)) {
                        $flowers = Flower::whereIn('id', $request->flowers)->get();
                        if(!empty($flowers)) {
                                $flowersName = [];
                                foreach ($flowers as $flower) {
                                        $flowersName[] = mb_strtolower($flower->name);
                                }

                                if(!empty($flowersName)) {
                                        $meta['title'] .= ' состав: '.implode(', ', $flowersName);
                                        $meta['keywords'] .= ', '. implode(', ', $flowersName);
                                }
                        }
                }

                $meta['title'] .= ' доставка в г '.$this->current_city->name;
                $meta['keywords'] .= ', '.$this->current_city->name;

                return $meta;
        }
        
        public function filter($query = null, Request $request) {

                if(empty($query)) {
                        return $this->catalog($request);
                }

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

        private function catalog(Request $request) {

                $popularProduct = Product::popular($this->current_city->id, $request, $request->page ? $request->page : 1, 36);;
                $title = 'Каталог букетов';
                $meta = [];

                if(!empty($this->user) && $this->user->admin) {
                        //dd($request->order);
                }

                if(!empty($request->order)) {
                        if($request->order == 'price') {
                                $title = 'Каталог букетов c низкими ценами';
                        }
                }

                return view('front.product.list',[
                        'title'                 => $title,
                        'meta'                  => $meta,
                        'popularProduct'        => $popularProduct,
                        'prices'                => Price::all(),
                        'sizes'                 => Size::all(),
                        'productTypes'          => ProductType::where('show_on_main', '1')->get(),
                        'currentType'           => null,
                        'colors'                => Color::all(),
                        'flowers'               => Flower::orderBy('popularity', 'desc')->limit(9)->get()
                ]);
        }

        public function changePrice(Request $request) {
                if(!empty($request->percent)) {

                        $statusCode = 200;
                        $message = '';

                        try {
                                $shop = $this->user->getShop();
                                \DB::update('UPDATE products SET price = price + (price * (?/100)) WHERE shop_id = ?', [(int)$request->percent, $shop->id]);
                                $message = "Цены успешно изменены";
                        } catch (\Exception $e) {
                                $statusCode = 400;
                                $message = $e->getMessage();
                        } finally {
                                return response()->json([
                                        'message' => $message,
                                        'code' => $statusCode
                                ], $statusCode);
                        }
                }

                return response()->json([
                        'message' => 'Укажите процент изменения цены',
                        'code' => 200
                ], 400);
        }
}

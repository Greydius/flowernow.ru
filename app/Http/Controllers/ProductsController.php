<?php

namespace App\Http\Controllers;

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
    //
        public function index(Request $request) {

                $viewFile = 'front.index';
                $title = '';
                $meta = [];
                $popularProducts = [];
                $popularProduct = [];
                $blocks = [];
                $city_id = $this->current_city->id;
                $promoText = null;
                $lowPriceProducts = null;
                $singleProducts = null;
                $currentType = null;
                $specialOffers = null;
                $specialOfferProducts = [];

                if(!empty($this->current_city) && $this->current_city->id == 637640 && empty($request->product_type)) {

                        $productRequest = Product::with(['shop'  => function($query) {
                                $query->select(['id', 'name', 'delivery_price', 'delivery_time']);
                        }, 'photos'])->whereRaw('products.shop_id IN (select shops.id from `shops` where `city_id` = '.(int)$this->current_city->id.'  and `active` = 1 and (`delivery_price` > 0 or `delivery_free` = 1))')
                                ->where('price', '>', 0)
                                ->where('dop', 0)
                                ->where('status', 1)
                                ->where('pause', 0)
                                ->whereNull('single')
                                ->orderBy('star', 'DESC')
                                ->orderBy('sort', 'DESC');

                        $blocks = Block::all();
                        $blockRequest = [];
                        foreach($blocks as $key => $block) {
                                $blockRequest[$key] = clone $productRequest;
                                $blockRequest[$key]->where('block_id', $block->id)->limit($block->items);
                        }

                        for($i=1; $i< count($blockRequest); $i++) {
                                $blockRequest[0]->unionAll($blockRequest[$i]);
                        }

                        $blockProducts = $blockRequest[0]->get();

                        foreach($blocks as $key => &$block) {
                                $products = [];
                                foreach($blockProducts as $product) {
                                        if($product->block_id == $block->id) {
                                                $products[] = $product;
                                        }
                                }

                                $blocks[$key]->products = $products;
                        }
                }


                $productTypes = ProductType::where('show_on_main', '1')->get();

                $singleProductsIds = [2, 23, 194, 40, 194, 84, 56, 16, 21, 70,
                  105, //красных тюльпанов
                  97, //красных гвоздик
                  116, //красных пионов
                  130, //разноцветных ирисов
                  //138, //белых калл
                  171, //белых фрезий
                  183, //белых гортензий
                  166 //белых анемонов
                ];

                // $singleProductsIds = [];
                $singleProducts = Product::popularSingle($this->current_city->id, $singleProductsIds);
                if(empty($blocks)) {
                        $singleProducts = Product::popularSingle2($this->current_city->id, $singleProductsIds, true)->limit(8)->get();
                }

                if(empty($request->product_type)) {
                        /*
                        $item = [];
                        $request->q = "новог";
                        $request->order = "rand";
                        $item['productType'] = null;
                        $item['popularProduct'] = Product::popular($this->current_city->id, $request, 1, 6);
                        $item['popularProductCount'] = count($item['popularProduct']);

                        if($item['popularProductCount']) {
                                $popularProducts[] = $item;
                        }

                        unset($request->q);
                        unset($request->order);
                        */

                        if(empty($blocks)) {
                                $item = [];
                                foreach ($productTypes as $productType) {
                                        //$request->product_type = $productType->slug;
                                        $request->productType = $productType->id;
                                        $item['productType'] = $productType;
                                        $item['popularProduct'] = Product::popular($this->current_city->id, $request, 1, 8);
                                        $item['popularProductCount'] = $item['popularProduct']->total() >=8 ? 8 : $item['popularProduct']->total();
                                        if($item['popularProductCount']) {
                                                $popularProducts[] = $item;
                                        }
                                }

                                unset($request->product_type);
                        }


                } else {
                        $request->product_type_filter = $request->product_type;
                        $productType = ProductType::where('slug', $request->product_type)->first();
                        if(!empty($productType) && !empty($productType->promo_text) && $this->current_city->id == 637640 && (empty($request->page) || $request->page == 1)) {
                                $promoText = new \stdClass();
                                $promoText->text = $productType->promo_text;
                        }
                        $title = $this->getTitle($request);
                        $meta =  $this->getMeta($request);
                        $viewFile = 'front.product.list';
                        $popularProduct = Product::popular($this->current_city->id, $request, (int)$request->page ? (int)$request->page : 1, 76);
                        $currentType = ProductType::where('slug', $request->product_type)->first();

                        $item = [];
                        foreach ($productTypes as $productType) {
                                $request->product_type = $productType->slug;
                                $item['productType'] = $productType;
                                $item['popularProduct'] = Product::popular($this->current_city->id, $request, 1, 1);
                                $item['popularProductCount'] = count($item['popularProduct']);
                                if($item['popularProductCount']) {
                                        $popularProducts[] = $item;
                                }
                        }
                        unset($request->product_type);
                }

                $specialOffers = \DB::table('special_offers')->whereRaw('? between date_from and date_to', [date('Y-m-d')])->get();

                if(!empty($specialOffers)) {
                        foreach ($specialOffers as $specialOffer) {
                                $specialOfferProduct = Product::whereHas('shop', function($query) use ($city_id) {
                                        $query->where('city_id', $city_id)->available();
                                })->where('price', '>', 0)->where('status', 1)->where('pause', 0)->whereRaw('FIND_IN_SET(? ,special_offer_id)', [$specialOffer->id]);

                                if($specialOfferProduct->count()) {
                                        $specialOfferProducts[$specialOffer->id] = $specialOfferProduct->inRandomOrder()->take(9)->get();
                                }
                        }
                }
                /*
                $lowPriceProducts = Product::whereHas('shop', function($query) use ($city_id) {
                                $query->where('city_id', $city_id)->available();
                        })
                        ->where('price', '>', 0)
                        ->where('status', 1)
                        ->where('pause', 0)
                        ->whereNotIn('product_type_id', [7, 8, 9, 10])
                        ->whereNull('single')
                        ->orderByRaw('(price + (SELECT delivery_price FROM shops WHERE shops.id = products.shop_id))')->take(9)->get();
                */

                if(empty($blocks)) {
                        if(!empty($popularProduct) && $popularProduct->total() <= 30) {
                                $request2 = new Request();
                                $request2->order = 'price';
                                $lowPriceProducts = Product::popular($this->current_city->id, $request2, 1, 76);
                                //dd($lowPriceProducts);
                        } else {
                                $lowPriceProducts = Product::lowPriceProducts($city_id)->take(12)->get();
                        }
                }

                if(!empty($this->user) && $this->user->admin) {
                        //dd($popularProduct);
                }

                if(!empty($request->flowers)) {
                        $promoText = \App\Model\PromoText::where('flower_id', $request->flowers[0])->where('type', 'info')->first();
                        if(!empty($promoText)) {

                        }
                }




                //$topFeedbackId = FeedbackCity::getCityTopFeedbackId($city_id);

                $feedback1 = Feedback::getTodayFeedback($city_id);
                $feedback2 =  Feedback::whereHas('shop', function($query) use ($city_id) {
                        $query->where('city_id', $city_id)->available();
                })->where('id', '!=', !empty($feedback1) ? $feedback1[0]->id : 0)->where('approved', 1)->orderBy('feedback_date_tmp', 'desc')->take(9)->get();



                if(!empty($feedback1)) {
                        $feedbacks = $feedback1->merge($feedback2);
                } else {
                        $feedbacks = $feedback2;
                }


                return view($viewFile,[
                        'title' => $title,
                        'meta' => $meta,
                        'promoText' => $promoText,
                        'popularProduct' => $popularProduct,
                        'popularProducts' => $popularProducts,
                        'lowPriceProducts' => $lowPriceProducts,
                        'singleProducts' => $singleProducts,
                        'currentType' => $currentType,
                        'specialOffers' => $specialOffers,
                        'specialOfferProducts' => $specialOfferProducts,
                        'feedbacks' => $feedbacks,
                        'blocks' => $blocks
                ]);
        }

        public function show($slug) {

                $product = Product::where('slug', $slug)->with('shop.city')->with('compositions.flower')->with('singleProduct')->withTrashed()->firstOrFail();

                $params = [
                        'product' => $product,
                        'shopIsAvailable' => Shop::where('id', $product->shop->id)->available()->count(),
                        'pageImage' => $product->photoUrl,
                        'pageTitle' => 'Доставка '.$product->name.' в г '.$product->shop->city->name.' - Заказ цветов',
                        'pageDescription' => 'Заказ доставки '.$product->name.' в г '.$product->shop->city->name.': цветы в офис, на дом, другой город.',
                        'pageKeywords' => $product->name.', букет, цветы, доставка, заказ, '.$product->shop->city->name,
                ];

                $size = getimagesize(public_path().$product->photoUrl);
                
                if($size) {
                        $params['pageImageWidth'] = $size[0];
                        $params['pageImageHeight'] = $size[1];
                }


                if(!empty($product->single)) {
                        if(empty($product->singleProduct)) {
                                return redirect()->route('front.index');
                        }
                        $singleProductIds = [];
                        $singleProducts = SingleProduct::where('parent_id', $product->singleProduct->parent_id)->get();

                        foreach ($singleProducts as $item) {
                                $singleProductIds[] = $item->id;
                        }

                        $shopSingleProducts = Product::where('shop_id', $product->shop_id)->whereIn('single', $singleProductIds)->where('price', '>', 0)->with('singleProduct')->get();
                        $params['shopSingleProducts'] = $shopSingleProducts;
                }

                $feedbacksCount = Feedback::where('shop_id', $product->shop_id)->where('approved', 1)->count();
                $feedbacks = Feedback::where('shop_id', $product->shop_id)->where('approved', 1)->orderBy('feedback_date', 'desc')->take(10)->get();
                $params['feedbacksCount'] = $feedbacksCount;
                $params['feedbacks'] = $feedbacks;

                $request = new Request();
                $request->shop_id = $product->shop_id;
                $request->notIn = [$product->id];
                $request->order = 'rand';
                $params['products'] = Product::popular($this->current_city->id, $request, 1, 9);

                return view('front.product.show', $params);
        }

        public function products() {

                $times = \App\Helpers\Data::times();

                $deletedProducts = 0;

                if($this->user->admin) {
                        $deletedProducts = Product::where('price', '>', 0)->where('dop', 0)->where('status', 1)->where('pause', 0)->whereNull('single')->onlyTrashed()->count();
                }

                return view('admin.products.list', [
                        'isDop' => false,
                        'productTypes' => ProductType::where('show_on_main', '1')->get(),
                        'colors' => Color::all(),
                        'specialOffers' => SpecialOffer::all(),
                        'flowers' => Flower::orderBy('name', 'asc')->get(),
                        'times' => $times,
                        'deletedProducts' => $deletedProducts,
                        'blocks' => Block::all()
                ]);
        }

        public function dopProducts() {

                $times = \App\Helpers\Data::times();

                return view('admin.products.list', [
                        'isDop' => true,
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
                $product->dop = !empty($request->isDop) ? 1 : 0;
                $product->name = Product::getNewProductName($shop->id, $product->dop);
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
                                $perPage = 40;
                                $productRequestModel = Product::with(['compositions.flower', 'photos', 'shop'])->whereNull('single')->orderByRaw("status = 2 DESC, status = 0 DESC, status = 1 DESC, updated_at DESC");

                                //$productSearchModel = \Connection::query();
                                //$builder = Model::query();

                                //dd($builder);

                                if(!empty($request->search)) {
/*
                                        $productSearchModel->orWhereHas('shop', function($query) use ($request) {
                                                $query->where('shops.name', 'like', "%$request->search%");
                                        });

                                        $productSearchModel->orWhereHas('shop.city', function($query) use ($request) {
                                                $query->where('cities.name', 'like', "%$request->search%");
                                        });
*/

                                        //$productRequestModel->merge($productRequestModel);

/*
                                        $productRequestModel->orWhereHas('shop', function($query) use ($request) {
                                                $query->where('shops.name', 'like', "%$request->search%");
                                        });

                                        $productRequestModel->orWhereHas('shop.city', function($query) use ($request) {
                                                $query->where('cities.name', 'like', "%$request->search%");
                                        });
*/
                                }

                               // echo $productRequestModel->toSql(); exit();
                        } elseif($this->user->isSupervisor()) {
                                $supervisorCitiesIds = $this->user->supervisor()->pluck('city_id')->toArray();

                                $productRequestModel  = Product::with(['compositions.flower', 'photos', 'shop'])->
                                        whereHas('shop', function ($query) use ($supervisorCitiesIds) {
                                                $query->whereIn('city_id', $supervisorCitiesIds);
                                        })
                                        ->whereNull('single')
                                        ->orderByRaw("status = 2 DESC, status = 0 DESC, status = 1 DESC, updated_at DESC");

                        } else {
                                $productRequestModel = $this->user->getShop()->products()->whereNull('single')->with(['compositions.flower', 'photos'])->orderByRaw("status = 0 DESC, status = 3 DESC, status = 2 DESC, status = 1 DESC, id DESC");
                        }

                        if(!empty((int)$request->dop)) {
                                $productRequestModel->where('dop', 1);
                        } else {
                                $productRequestModel->where('dop', 0);
                        }

                        $productRequestModel->where(function($query) use ($request) {

                                if(!empty($request->search)) {

                                        if($this->user->admin) {
                                                $query->orWhereHas('shop', function ($query) use ($request) {
                                                        $query->where('shops.name', 'like', "%$request->search%");
                                                });

                                                $query->orWhereHas('shop.city', function ($query) use ($request) {
                                                        $query->where('cities.name', 'like', "%$request->search%");
                                                });
                                        }

                                        $query->orWhere('products.id', $request->search)->orWhere('products.name', 'like', "%$request->search%")->orWhere('products.description', 'like', "%$request->search%");
                                }
                        });

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

        public function rotatePhoto($id, Request $request) {

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

                                $deg = 90;

                                $src = Product::$fileUrl.$photo->product->shop_id.'/'.$photo->photo;
                                $image = imagecreatefromstring(file_get_contents(public_path($src)));
                                $image = imagerotate($image, $deg, 0);

                                imagejpeg($image,public_path($src),100);
                                rename(public_path($src), public_path(Product::$fileUrl.$photo->product->shop_id.'/r'.$photo->photo));

                                $src = Product::$fileUrl.'632x632/'.$photo->product->shop_id.'/'.$photo->photo;
                                $image = imagecreatefromstring(file_get_contents(public_path($src)));
                                $image = imagerotate($image, $deg, 0);

                                imagejpeg($image,public_path($src),100);
                                rename(public_path($src), public_path(Product::$fileUrl.'632x632/'.$photo->product->shop_id.'/r'.$photo->photo));

                                $photo->photo = 'r'.$photo->photo;
                                $photo->save();
                        }

                        $return['photos'] = ProductPhoto::where('product_id', $photo->product_id)->get();

                } catch (\Exception $e){
                        $return['statusCode'] = 400;
                        $return['message'] = $e->getMessage();
                }finally{
                        return response()->json($return, $return['statusCode']);
                }

        }

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

        public function apiChangeBlockProduct($id, Request $request) {

                $return = [
                        'statusCode' => 200,
                        'message' => ''
                ];

                try{
                        $product = null;

                        if($this->user->admin || $this->user->isSupervisor()) {
                                $product = Product::find($id);
                        }

                        if(empty($product)) {
                                throw new \Exception('Продукт не найден');
                        } else {
                                $product->block_id = $request->block_id;
                                $product->save();
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

        public function apiChangeStarProduct($id, Request $request) {

                $return = [
                        'statusCode' => 200,
                        'message' => ''
                ];

                try{
                        $product = Product::find($id);
                        $shop = $this->user->getShop();

                        if(empty($product) || !isset($request->star) || !$this->user->isSupervisor($product->shop->city->id)) {
                                throw new \Exception('Продукт не найден');
                        } else {
                                $product->star = (int)$request->star ? 1 : 0;
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

                $product = Product::findOrFail($request->input('id'));

                $validator = Validator::make($request->all(), (!empty($product->dop) ? Product::$productDopRules : Product::$productRules), (!empty($product->dop) ? Product::$productDopRulesMessages : Product::$productRulesMessages));

                if ($validator->fails()) {

                    return response()->json([
                        'error' => true,
                        'message' => $validator->messages()->first(),
                        'code' => 400
                    ], 400);

                }

                $shop = $this->user->getShop();

                if(empty($product) || (!$this->user->admin && $shop->id != $product->shop_id && !$this->user->isSupervisor($shop->city_id))) {
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
                $product->width = (int)$request->input('width');
                $product->height = (int)$request->input('height');
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
                        if(!$this->user->admin && ($updated_at != $product->updated_at || $product->status == 0) && !$this->user->isSupervisor($shop->city_id)) {
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
                $title['type'] = 'Букеты и композиции из цветов';

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
                                $title['color'] = ''.mb_strtolower($color->name);
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
                                        $title['flowers'] = ''.implode(', ', $flowersName);
                                }
                        }
                }

                //$title['price'] = null;
                if(!empty($request->productPrice)) {
                        $price = Price::find($request->productPrice);
                        if(!empty($price)) {
                                $title['price'] = ''.mb_strtolower($price->name);
                        }
                } elseif(!empty($request->price_from) || !empty($request->price_to)) {
                        $title['price'] = '';
                        if(!empty($request->price_from)) {
                                $title['price'] .= (int)$request->price_from >= 2000 ? ((int)$request->price_from + 1).' - ' : null;
                        }

                        if(!empty($request->price_to)) {
                                $title['price'] .= (int)$request->price_to < 9999999 ? ((int)$request->price_to == 1999 ? 'до ' : '') . ((int)$request->price_to + 1) : null;
                        }

                        $title['price'] .= ' руб';
                }

                $result = implode(', ', $title);

                if(mb_strpos($result, '{city}') === false) {
                        //$result .= ' с доставкой в <a href="#" class="choose-city-link" onclick="chooseCity(); return false;">г.'.$this->current_city->name.'</a>';
                        $result .= ' с доставкой в '.$this->current_city->name;
                } else {
                        //$result = str_replace('{city}', '<a href="#" class="choose-city-link" onclick="chooseCity(); return false;">г.'.$this->current_city->name.'</a>', $result);
                        $result = str_replace('{city}', $this->current_city->name, $result);
                }

                //return implode(', ', $title).' с доставкой в <a href="#" class="choose-city-link" onclick="chooseCity(); return false;">г.'.$this->current_city->name.'</a>';
                return $result;
        }

        public function getMeta(Request $request) {

                $meta = [];


                $meta['title'] = 'Букеты и композиции из цветов';
                $meta['keywords'] = '';

                if(!empty($request->product_type)) {
                        $productType = ProductType::where('slug', $request->product_type)->first();
                        if(!empty($productType)) {
                                $meta['title'] = $productType->alt_name;
                                if(!empty($productType->description)) {
                                        $meta['description'] = $productType->description;
                                        if(mb_strpos($meta['description'], '{city}') != false) {
                                                $meta['description'] = str_replace('{city}', $this->current_city->name_prepositional, $meta['description']);
                                        }
                                }

                                if(!empty($productType->keywords)) {
                                        $meta['keywords'] = $productType->keywords;
                                        if(mb_strpos($meta['keywords'], '{city}') != false) {
                                                $meta['keywords'] = str_replace('{city}', $this->current_city->name, $meta['keywords']);
                                        }
                                }
                        }
                }

                if(empty($meta['description'])) {
                        $meta['description'] = 'Заказать ';
                        $meta['description'] .= mb_strtolower($meta['title']);
                        $meta['description'] .= ' в г '.$this->current_city->name.' с доставкой';
                }

                if(empty($meta['keywords'])) {
                        $meta['keywords'] .= mb_strtolower($meta['title']);
                }
                
                if(!empty($request->flowers) && is_array($request->flowers)) {
                        $flowers = Flower::whereIn('id', $request->flowers)->get();
                        if(!empty($flowers)) {
                                $flowersName = [];
                                foreach ($flowers as $flower) {
                                        $flowersName[] = mb_strtolower($flower->name);
                                }

                                if(!empty($flowersName)) {
                                        $meta['title'] .= ''.implode(', ', $flowersName);
                                        $meta['keywords'] .= ', '. implode(', ', $flowersName);
                                }
                        }
                }

                //$meta['title'] .= ' доставка в г '.$this->current_city->name;
                $meta['title'] = mb_strpos($meta['title'], '{city}') === false ? $meta['title'].' в г '.$this->current_city->name : str_replace('{city}', $this->current_city->name, $meta['title']);
                //$meta['keywords'] .= ', '.$this->current_city->name;

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
                                        print_r*
                                        $request->flowers = array_merge($request->flowers, [$flower->id]);
                                }
                        }
                        return $this->index($request);
                } elseif(count($queries) == 1) {
                        if($queries[0] == 'single') {
                                $request->single = true;
                                return $this->catalog($request);
                        } elseif($queries[0] == 'archive') {
                                $request->deleted = true;
                                return $this->catalog($request);
                        }
                }

                return redirect()->route('front.index');
        }

        private function catalog(Request $request) {

                $popularProduct = Product::popular($this->current_city->id, $request, $request->page ? $request->page : 1, 76);
                $title = 'Каталог букетов';
                $meta = [];

                if(!empty($this->user) && $this->user->admin) {
                        //dd($popularProduct); exit();
                }

                if(!empty($request->order)) {
                        if($request->order == 'price') {
                                $title = 'Каталог букетов c низкими ценами';
                        }
                }

                if($request->single) {
                        $title = 'Букеты цветов поштучно';
                }

                if($request->deleted) {
                        $title = 'Архив букетов';
                }

                $lowPriceProducts = null;

                if($request->q) {
                        $title = 'Поиск "'.$request->q.'"';

                        if(!empty($popularProduct) && $popularProduct->total() <= 30) {
                                $request2 = new Request();
                                $request2->order = 'price';
                                $lowPriceProducts = Product::popular($this->current_city->id, $request2, 1, 76);
                        }
                }

                $productTypes = ProductType::where('show_on_main', '1')->get();
                $item = $popularProducts =[];

                foreach ($productTypes as $productType) {
                        $request->product_type = $productType->slug;
                        $item['productType'] = $productType;
                        $item['popularProduct'] = Product::popular($this->current_city->id, $request, 1, 6);
                        $item['popularProductCount'] = count($item['popularProduct']);
                        if($item['popularProductCount']) {
                                $popularProducts[] = $item;
                        }
                }

                if($request->single) {
                        $title = 'Букеты цветов поштучно';
                }


                return view('front.product.list',[
                        'title'                 => $title,
                        'meta'                  => $meta,
                        'popularProduct'        => $popularProduct,
                        'lowPriceProducts'      => $lowPriceProducts,
                        'prices'                => Price::all(),
                        'sizes'                 => Size::all(),
                        'productTypes'          => $productTypes,
                        'currentType'           => null,
                        'colors'                => Color::all(),
                        'flowers'               => Flower::orderBy('popularity', 'desc')->limit(9)->get(),
                        'popularProducts'       => $popularProducts
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

        public function single() {

                \App\Model\SingleProduct::copyProductsToShop($this->user->getShop()->id);

                $products = SingleProduct::mainCategory();

                return view('admin.products.single-categories',[
                        'products' => $products
                ]);
        }

        public function singleCategory($parent_id) {

                /*
                $products = $this->user->getShop()->products()->whereNotNull('single')->with(['single' => function ($query) use ($parent_id) {

                    $query->where('parent_id', $parent_id);
                }])->get();
                */

                $products = $this->user->getShop()->products()
                        ->select('products.*', 'single_products.qty_from', 'single_products.qty_to')
                        ->whereNotNull('products.single')
                        ->join('single_products', 'single_products.id', '=', 'products.single')
                        ->where('single_products.parent_id', $parent_id)
                        ->get();

                return view('admin.products.single-list',[
                        'products' => $products
                ]);
        }

        public function apiSingleProductSavePrice($id, Request $request) {

                $return = [
                        'statusCode' => 200,
                        'message' => ''
                ];

                try{
                        if($this->user->admin) {
                                $product = Product::find($id);
                        } else {
                                $product = $this->user->getShop()->products()->where('id', $id)->first();
                        }

                        if(empty($product)) {
                                throw new \Exception('Продукт не найден');
                        } else {
                                $product->price = $request->price;
                                $product->save();
                        }

                        $return['product'] = $product;

                } catch (\Exception $e){
                        $return['statusCode'] = 400;
                        $return['message'] = $e->getMessage();
                }finally{
                        return response()->json($return, $return['statusCode']);
                }

        }

        public function getProductByQty(Request $request) {
                $statusCode = 200;
                $response = [
                        'product' => []
                ];

                try{
                        $product = Product::with('singleProduct')->findOrFail($request->product_id);

                        if(!empty($product->single)) {
                                $singleProduct = SingleProduct::where('parent_id', $product->singleProduct->parent_id)->whereRaw((int)$request->qty." BETWEEN qty_from AND qty_to ")->with('parent')->first();

                                $product = Product::where('shop_id', $product->shop_id)->where('single', $singleProduct->id)->first();

                                if($singleProduct->qty_from != $request->qty) {
                                        $product->name = $singleProduct->parent->name;
                                }

                                $product->qty = (int)$request->qty;
                                $response['cart_link'] = route('order.add', ['product_id' => $product->id, 'qty' => $product->qty]);
                        }

                        $response['product'] = $product->makeHidden(['shop', 'price']);

                } catch (\Exception $e){
                    $statusCode = 400;
                }finally{
                    return response()->json($response, $statusCode);
                }
        }

        function singleStat() {

                $shops = Shop::with(['city', 'products' => function($q) {
                        $q->select('id', 'shop_id', 'single', 'price')->whereNotNull('single');
                }])->simplePaginate(15);

                $products = [];

                foreach ($shops as $shop) {
                        foreach ($shop->products as $product) {
                                $products[$shop->id][$product->single] = $product->price;
                        }
                }

                return view('admin.products.single-stat',[
                        'singles' => SingleProduct::where('parent_id', '>', 0)->get(),
                        'shops' => $shops,
                        'products' => $products
                ]);
        }

        public function apiToDopProduct($id, Request $request) {

                $return = [
                        'statusCode' => 200,
                        'message' => ''
                ];

                try{
                        $product = null;

                        $product = Product::find($id);

                        if(empty($product)) {
                                throw new \Exception('Продукт не найден');
                        } else {
                                 $product->dop = $product->dop ? 0 : 1;
                                 $product->save();
                        }

                } catch (\Exception $e){
                        $return['statusCode'] = 400;
                        $return['message'] = $e->getMessage();
                }finally{
                        return response()->json($return, $return['statusCode']);
                }

        }

        public function copy() {
                $shops = Shop::get();

                return view('admin.products.copy',[
                        'shops' => $shops,
                ]);
        }

        public function copyProcess(Request $request) {


                if(!empty($request->from_shop_id) && !empty($request->to_shop_id)) {
                        $products = Product::where('shop_id', $request->from_shop_id)
                                ->whereNull('single')
                                //->where('status', 1)
                                ->with(['compositions', 'photos'])
                                ->get();

                        \DB::beginTransaction();

                        try{

                                foreach($products as $product) {

                                        $newProduct = $product->replicate();
                                        $newProduct->shop_id = $request->to_shop_id;
                                        $newProduct->status = 3;
                                        $newProduct->slug = Product::getNewProductSlug($newProduct->name);
                                        $newProduct->save();


                                        foreach($product->photos as $photo) {
                                                $filePathNew = Product::$fileUrl.$request->to_shop_id.'/';
                                                $filePathOld = Product::$fileUrl.$request->from_shop_id.'/';

                                                $filePathNew632 = Product::$fileUrl.'632x632/'.$request->to_shop_id.'/';
                                                $filePathOld632 = Product::$fileUrl.'632x632/'.$request->from_shop_id.'/';

                                                if(!file_exists(public_path($filePathNew))) {
                                                        \File::makeDirectory(public_path($filePathNew));
                                                }

                                                if(!file_exists(public_path($filePathNew632))) {
                                                        \File::makeDirectory(public_path($filePathNew632));
                                                }

                                                if (!copy(public_path($filePathOld.$photo->photo), public_path($filePathNew.$photo->photo)) ||
                                                        !copy(public_path($filePathOld632.$photo->photo), public_path($filePathNew632.$photo->photo)) ) {
                                                        throw new \Exception('Copy error');
                                                }

                                                /*
                                                $newProductPhoto = $photo->replicate();
                                                $newProductPhoto->product_id = $newProduct->id;
                                                if($newProductPhoto->save()) {
                                                        $filePathNew = Product::$fileUrl.$request->to_shop_id.'/';
                                                        $filePathOld = Product::$fileUrl.$request->from_shop_id.'/';

                                                        $filePathNew632 = Product::$fileUrl.'632x632/'.$request->to_shop_id.'/';
                                                        $filePathOld632 = Product::$fileUrl.'632x632/'.$request->from_shop_id.'/';

                                                        if(!file_exists(public_path($filePathNew))) {
                                                                \File::makeDirectory(public_path($filePathNew));
                                                        }

                                                        if(!file_exists(public_path($filePathNew632))) {
                                                                \File::makeDirectory(public_path($filePathNew632));
                                                        }

                                                        if (!copy(public_path($filePathOld.$newProductPhoto->photo), public_path($filePathNew.$newProductPhoto->photo)) &&
                                                                !copy(public_path($filePathOld632.$newProductPhoto->photo), public_path($filePathNew632.$newProductPhoto->photo)) ) {
                                                                throw new \Exception('Copy error');
                                                        }
                                                }
                                                */
                                        }


                                        foreach($product->compositions as $composition) {
                                                $newProductComposition = $composition->replicate();
                                                $newProductComposition->product_id = $newProduct->id;
                                                $newProductComposition->save();
                                        }
                                }

                                \DB::commit();

                        } catch (\Exception $e) {

                                \DB::rollBack();

                                dd($e);
                        }

                        \Session::flash('layoutWarning', ['type' => 'success', 'text' => 'Товары успешно скопированы!']);
                }

                return redirect()->route('products.copy');
        }

        public function apiProduct($id, Request $request) {

                $statusCode = 200;
                $message = '';

                try{
                        $product = Product::find($id);

                        if(empty($product)) {
                                throw new \Exception('Продукт не найден');
                        }

                } catch (\Exception $e){
                        $statusCode = 400;
                        $message = $e->getMessage();
                } finally {
                        return response()->json([
                                'product' => $product,
                                'message' => $message,
                                'code' => $statusCode
                        ], $statusCode);
                }
        }
}

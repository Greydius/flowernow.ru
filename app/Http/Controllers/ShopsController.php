<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelper;
use App\Model\Product;
use App\Model\Order;
use App\Model\Shop;
use App\Model\ShopAddress;
use App\Model\ShopWorkTime;
use App\Model\ShopWorker;
use App\Model\Feedback;
use App\Model\Banner;
use App\Model\ShopReport;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Image;
use Dompdf\Dompdf;
use Dompdf\Options;

class ShopsController extends Controller
{
    //
        public function shops() {

                return view('admin.shop.list', [

                ]);
        }

        public function profile($id = null) {

                if(!empty($id)) {
                        $shop = Shop::findOrFail($id);
                } else {
                        $shop = $this->user->getShop();
                }

                $reportsDate = [];

                $firstOrder = $shop->orders()->where('payed', 1)->where('payment', '!=', 'cash')->first();

                if(!empty($firstOrder)) {

                        $reportDate = \Carbon\Carbon::parse($firstOrder->payed_at);
                        $nowDate = \Carbon\Carbon::now();
                        do {
                                $reportsDate[] = clone $reportDate;
                                $reportDate->addMonthsNoOverflow(1);

                        } while($reportDate < $nowDate);
                }

                return view('admin.shop.profile', [
                        'shop' => $shop,
                        'reportsDate' => $reportsDate,
                        'reports' => $shop->reports()->orderBy('report_date')->get()
                ]);
        }

        public function profile2() {

                //$shop = $this->user->shops()->with('address')->first();

                //dd($shop->address[0]->name);

                return view('admin.shop.profile2', [

                ]);
        }

        public function apiProfile($id = null) {

                $statusCode = 200;
                $response = [
                        'shop' => []
                ];

                if($this->user->admin) {
                        $shop = Shop::findOrFail($id);
                } else {
                        $shop = $this->user->getShop();
                }

                try{
                        $response['shop'] = $shop;
                } catch (\Exception $e){
                    $statusCode = 400;
                }finally{
                    return response()->json($response, $statusCode);
                }
        }

        public function uploadLogo($id, Request $request) {

                $photo = Input::all();

                $shop = Shop::with(['users'])->findOrFail($id);
                $user_id = $this->user->id;

                if(!$this->user->admin) {
                        $user_shop = $this->user->getShop();
                        if($user_shop->id != $shop->id) {
                                return response()->json([
                                    'error' => true,
                                    'code'  => 403
                                ], 403);
                        }
                } else {
                        $user_id = $shop->users[0]->id;
                }

                $validator = Validator::make($photo, Shop::$logoRules, Shop::$logoRulesMessages);

                if ($validator->fails()) {

                    return response()->json([
                        'error' => true,
                        'message' => $validator->messages()->first(),
                        'code' => 400
                    ], 400);

                }

                $photo = $photo['file'];

                $originalName = $photo->getClientOriginalName();
                $extension = $photo->getClientOriginalExtension();
                $originalNameWithoutExt = substr($originalName, 0, strlen($originalName) - strlen($extension) - 1);

                //$filename = Slug::make($originalNameWithoutExt, '_');
                $filename = str_slug($originalNameWithoutExt, '_').'.'.$extension;
                $filename = 'logo_'.$user_id.'_'.time().'.'.$extension;
                $filePath = Shop::$fileUrl.$user_id.'/';
                $fullFileName = $filePath . $filename;

                if(!file_exists(public_path($filePath))) {
                        \File::makeDirectory(public_path($filePath));
                }

                Image::make($photo)->save( public_path($fullFileName ) );

                $shop->logo = $fullFileName;

                $shop->save();

                return response()->json([
                    'error' => false,
                    'code'  => 200
                ], 200);

        }

        public function uploadPhoto($id, Request $request) {

                $photo = Input::all();

                $shop = Shop::with(['users'])->findOrFail($id);
                $user_id = $this->user->id;

                if(!$this->user->admin) {
                        $user_shop = $this->user->getShop();
                        if($user_shop->id != $shop->id) {
                                return response()->json([
                                    'error' => true,
                                    'code'  => 403
                                ], 403);
                        }
                } else {
                        $user_id = $shop->users[0]->id;
                }


                $validator = Validator::make($photo, Shop::$logoRules, Shop::$logoRulesMessages);

                if ($validator->fails()) {

                    return response()->json([
                        'error' => true,
                        'message' => $validator->messages()->first(),
                        'code' => 400
                    ], 400);

                }

                $photo = $photo['file'];

                $originalName = $photo->getClientOriginalName();
                $extension = $photo->getClientOriginalExtension();
                $originalNameWithoutExt = substr($originalName, 0, strlen($originalName) - strlen($extension) - 1);

                //$filename = Slug::make($originalNameWithoutExt, '_');
                $filename = str_slug($originalNameWithoutExt, '_').'.'.$extension;
                $filename = 'photo_'.$user_id.'_'.time().'.'.$extension;
                $filePath = Shop::$fileUrl.$user_id.'/';
                $fullFileName = $filePath . $filename;

                if(!file_exists(public_path($filePath))) {
                        \File::makeDirectory(public_path($filePath));
                }

                Image::make($photo)->save( public_path($fullFileName ) );

                $shop->photo = $fullFileName;

                $shop->save();

                return response()->json([
                    'error' => false,
                    'code'  => 200
                ], 200);

        }

        public function update($id, Request $request) {

                $statusCode = 200;
                $response = [];

                try{
                        if(!$this->user->admin) {
                                $shop = $this->user->getShop();
                        } else {
                                $shop = Shop::findOrFail($id);
                        }

                        if(empty($request->name)) {
                                return response()->json([
                                        'error' => true,
                                        'message' => 'Название магазина не может быть пустым',
                                        'code' => 400
                                ], 400);
                        }

                        if(!empty($request->email) && !filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
                                return response()->json([
                                        'error' => true,
                                        'message' => 'Email указан неверно!',
                                        'code' => 400
                                ], 400);
                        }

                        if($shop->name != $request->name) {

                        }

                        if(!empty($request->new_pwd)) {
                                $shop_user = $shop->users[0];
                                $shop_user->password = bcrypt($request->new_pwd);
                                $shop_user->save();
                        }

                        $shop->name = $request->name;
                        $shop->about = $request->about;
                        $shop->contact_phone = $request->contact_phone;
                        $shop->email = $request->email;
                        $shop->site = $request->site;
                        $shop->vk = $request->vk;
                        $shop->ok = $request->ok;
                        $shop->fb = $request->fb;
                        $shop->instagram = $request->instagram;
                        $shop->youtube = $request->youtube;

                        $shop->delivery_price = (int)$request->delivery_price;
                        $shop->delivery_time = AppHelper::formatTimeToMinutes($request->delivery_time_format);
                        $shop->delivery_out = !empty($request->delivery_out) ? 1 : 0;
                        $shop->delivery_out_max = (int)$request->delivery_out_max;
                        $shop->delivery_out_price = (int)$request->delivery_out_price;
                        $shop->delivery_free = !empty($request->delivery_free) ? 1 : 0;

                        $shop->org_name = $request->org_name;
                        $shop->rs = $request->rs;
                        $shop->bank = $request->bank;
                        $shop->bik = $request->bik;
                        $shop->ks = $request->ks;
                        $shop->inn = $request->inn;
                        $shop->kpp = $request->kpp;
                        $shop->ogrn = $request->ogrn;
                        $shop->org_address = $request->org_address;
                        $shop->director = $request->director;
                        $shop->osnovanie = $request->osnovanie;

                        $shop->round_clock = (int)$request->shop_round_clock;

                        if($this->user->admin) {
                                $shop->active = !empty($request->active) ? 1 : 0;
                        }


                        $shop->save();

                        $address_ids = [];
                        $i = 0;

                        foreach($request->address as $key => $value) {
                                $id = !empty($value['id']) ? $value['id'] : null;
                                if(!empty($value['name'])) {

                                        if(!empty($id)) {

                                                $address = ShopAddress::where('id', $id)->where('shop_id', $shop->id)->first();

                                                if(!empty($address)) {
                                                        $address_ids[] = $id;
                                                        $address->name = $value['name'];
                                                        $address->save();
                                                }

                                        } else {

                                                $address = new ShopAddress();
                                                $address->name = $value['name'];
                                                $address->shop_id = $shop->id;
                                                $address->city_id = $shop->city_id;
                                                $address->save();
                                                $address_ids[] = $address->id;
                                        }
                                }

                                $i++;
                        }

                        if(!empty($address_ids)) {
                                ShopAddress::where('shop_id', $shop->id)->whereNotIn('id', $address_ids)->delete();
                        }

                        $works_time_ids = [];
                        $i = 0;

                        for($i=0; $i<=6; $i++) {
                                $shopWorkTime = ShopWorkTime::where('shop_id', $shop->id)->where('day', $i)->first();
                                if(empty($shopWorkTime)) {
                                        $shopWorkTime = new ShopWorkTime();
                                }

                                $shopWorkTime->shop_id = $shop->id;

                                $shopWorkTime->day = $i;
                                $shopWorkTime->is_work = !empty($request->work_day[$i]) ? 1 : 0;
                                $shopWorkTime->round_clock = !empty($request->round_clock[$i]) ? 1 : 0;
                                if(!$shopWorkTime->round_clock) {
                                        $shopWorkTime->work_from = AppHelper::formatTimeToMinutes($request->work_from[$i]);
                                        $shopWorkTime->work_to = AppHelper::formatTimeToMinutes($request->work_to[$i]);
                                }

                                $shopWorkTime->save();
                        }


                        if(!empty($request->worker_director)) {
                                $workers_ids = [];
                                $i = 0;

                                foreach($request->worker_director as $key => $value) {
                                        $id = !empty($value['id']) ? $value['id'] : null;
                                        if(!empty($value['name'])) {

                                                if(!empty($id)) {

                                                        $worker = ShopWorker::where('id', $id)->where('shop_id', $shop->id)->first();

                                                        if(!empty($worker)) {
                                                                $workers_ids[] = $id;
                                                                $worker->name = $value['name'];
                                                                $worker->email = !empty($value['email']) && filter_var($value['email'], FILTER_VALIDATE_EMAIL) ? $value['email'] : '';
                                                                $worker->phone = $value['phone'];
                                                                $worker->notify = !empty($value['notify']) ? 1 : 0;
                                                                $worker->save();
                                                        }

                                                } else {

                                                        $worker = new ShopWorker();
                                                        $worker->name = $value['name'];
                                                        $worker->position_id = 1;
                                                        $worker->email = !empty($value['email']) && filter_var($value['email'], FILTER_VALIDATE_EMAIL) ? $value['email'] : '';
                                                        $worker->phone = $value['phone'];
                                                        $worker->notify = !empty($value['notify']) ? 1 : 0;
                                                        $worker->shop_id = $shop->id;

                                                        $worker->save();
                                                        $workers_ids[] = $worker->id;
                                                }
                                        }

                                        $i++;
                                }

                                if(!empty($workers_ids)) {
                                        ShopWorker::where('shop_id', $shop->id)->whereNotIn('id', $workers_ids)->where('position_id', 1)->delete();
                                }
                        } else {
                                ShopWorker::where('shop_id', $shop->id)->where('position_id', 1)->delete();
                        }

                        if(!empty($request->worker_florist)) {

                                $workers_ids = [];
                                $i = 0;

                                foreach($request->worker_florist as $key => $value) {
                                        $id = !empty($value['id']) ? $value['id'] : null;
                                        if(!empty($value['name'])) {

                                                if(!empty($id)) {

                                                        $worker = ShopWorker::where('id', $id)->where('shop_id', $shop->id)->first();

                                                        if(!empty($worker)) {
                                                                $workers_ids[] = $id;
                                                                $worker->name = $value['name'];
                                                                $worker->email = !empty($value['email']) && filter_var($value['email'], FILTER_VALIDATE_EMAIL) ? $value['email'] : '';
                                                                $worker->phone = $value['phone'];
                                                                $worker->notify = !empty($value['notify']) ? 1 : 0;
                                                                $worker->save();
                                                        }

                                                } else {

                                                        $worker = new ShopWorker();
                                                        $worker->name = $value['name'];
                                                        $worker->position_id = 2;
                                                        $worker->email = !empty($value['email']) && filter_var($value['email'], FILTER_VALIDATE_EMAIL) ? $value['email'] : '';
                                                        $worker->phone = $value['phone'];
                                                        $worker->notify = !empty($value['notify']) ? 1 : 0;
                                                        $worker->shop_id = $shop->id;

                                                        $worker->save();
                                                        $workers_ids[] = $worker->id;
                                                }
                                        }

                                        $i++;
                                }

                                if(!empty($workers_ids)) {
                                        ShopWorker::where('shop_id', $shop->id)->whereNotIn('id', $workers_ids)->where('position_id', 2)->delete();
                                }
                        } else {
                                ShopWorker::where('shop_id', $shop->id)->where('position_id', 2)->delete();
                        }

                        return response()->json([
                            'error' => false,
                            'code'  => 200
                        ], 200);

                } catch (\Exception $e){
                    $statusCode = 400;

                    return response()->json([
                        'error' => true,
                        'message' => 'Ошибка сохранения. '.$e->getMessage(),
                        'code' => $statusCode
                ], $statusCode);
                }


        }

        public function apiList(Request $request) {

                $statusCode = 200;
                $response = [
                        'shops' => []
                ];

                try{
                        $perPage = 100;
                        $shop = Shop::with(['users', 'city'])->select('shops.*',
                                \DB::raw('(SELECT MAX(products.updated_at) FROM products WHERE products.shop_id = shops.id) AS product_last_update'),
                                \DB::raw('(SELECT COUNT(*) FROM products WHERE products.shop_id = shops.id AND products.status = 0 AND products.single IS NULL AND products.deleted_at IS NULL) AS product_status_0'),
                                \DB::raw('(SELECT COUNT(*) FROM products WHERE products.shop_id = shops.id AND products.status = 1 AND products.single IS NULL AND products.deleted_at IS NULL) AS product_status_1'),
                                \DB::raw('(SELECT COUNT(*) FROM products WHERE products.shop_id = shops.id AND products.status = 2 AND products.single IS NULL AND products.deleted_at IS NULL) AS product_status_2'),
                                \DB::raw('(SELECT COUNT(*) FROM products WHERE products.shop_id = shops.id AND products.status = 3 AND products.single IS NULL AND products.deleted_at IS NULL) AS product_status_3'),
                                \DB::raw('(SELECT COUNT(*) FROM feedback WHERE feedback.shop_id = shops.id and feedback.approved = 1) AS feedbacks_count'),
                                \DB::raw('(SELECT DATE_FORMAT(feedback_date, \'%Y-%m-%d\') FROM feedback WHERE feedback.shop_id = shops.id and feedback.approved = 1 ORDER BY feedback_date DESC LIMIT 1) AS feedback_date')
                        )->whereNull('copy_id')->orderBy('id', 'desc');
                        if(!empty($request->search)) {
                             $shop->where('name', 'like', "%$request->search%");


                             $shop->orWhereHas('city', function($query) use ($request) {
                                $query->where('cities.name', 'like', "%$request->search%");
                             });

                             $shop->orWhereHas('users', function($query) use ($request) {
                                $query->where('users.phone', 'like', "%$request->search%");
                             });

                        }
                        //echo $shop->toSql(); exit();
                        $response['shops'] = $shop->paginate($perPage);

                } catch (\Exception $e){
                    $statusCode = 400;
                }finally{
                    return response()->json($response, $statusCode);
                }
        }

        public function products($id, Request $request) {
                $shop = Shop::with(['address.city', 'workTime'])->findOrFail($id);

                $request->shop_id = $shop->id;

                $products = Product::popular($this->current_city->id, $request, $request->page ? $request->page : 1, 36);

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
                //$singleProducts = Product::popularSingle($this->current_city->id, $singleProductsIds);
                $singleProducts = Product::popularSingle2($this->current_city->id, $singleProductsIds, true, $request, $request->page ? $request->page : 1, 36)->get();

                return view('front.shop.products',[
                        'products' => $products,
                        'singleProducts' => $singleProducts,
                        'shop' => $shop,
                        'feedbacks' => Feedback::where('shop_id', $shop->id)->where('approved', 1)->orderBy('feedback_date', 'desc')->take(10)->get(),
                        'meta' => [
                                'title' => 'Доставка цветов в '.$this->current_city->name_prepositional.' | '.$shop->name,
                                'description' => null,
                                'keywords' => null
                        ]
                ]);
        }

        public function sendProductEmail($shop_id) {

                /*
                $products = Shop::find($shop_id)->products()->whereIn('status', [0, 3])->with(['shop'])->get();

                if(count($products) && $products[0]->shop->email) {
                        Mail::send('email.shopProductBan', ['products' => $products], function ($message) use ($products) {
                                $message->to([$products[0]->shop->email])
                                        ->subject('Внимание от Floristum.ru');
                        });
                }
                */

                $shop = Shop::find($shop_id);

                $products = Product::where('shop_id', $shop->id)->whereIn('status', [0, 3])->whereNull('single')->get();
                $totalProductsCount = Product::where('shop_id', $shop->id)->whereNull('single')->count();

                if($shop->email) {
                        Mail::send('email.shopProductBan2', ['products' => $products, 'shop' => $shop, 'totalProductsCount' => $totalProductsCount], function ($message) use ($shop) {
                                $message->to([$shop->email])
                                        ->subject('Уведомление для '.$shop->name.' на Floristum.ru');
                        });
                }

                return response()->json([], 200);
        }

        public function partnership() {

                $shop = $this->user->getShop();

                $banner = Banner::where('shop_id', $shop->id)->first();

                $href = route('shop.products', [
                        'id' => $shop->id
                ], false);

                $href = !empty($shop->city->slug) && $shop->city->slug != 'moskva' ? 'http://'.$shop->city->slug.'.floristum.ru'.$href : 'https://floristum.ru'.$href;

                $src = "https://floristum.ru/assets/front/img/logo_floristum_mini.png";

                $banners = [
                        '<a href="'.$href.'">
<img src="'.$src.'" alt="доставка цветов в '.$shop->city->name_prepositional.'">
Наши букеты на floristum.ru
</a>',
                        '<a href="'.$href.'">
<img src="'.$src.'" alt="Букеты в '.$shop->city->name_prepositional.'">
Наши цветы на floristum.ru
</a>',
                        '<a href="'.$href.'">
<img src="'.$src.'" alt="доставка цветов в '.$shop->city->name_prepositional.'">
Мы на floristum.ru
</a>',
                        '<a href="'.$href.'">
<img src="'.$src.'" alt="цветы в '.$shop->city->name_prepositional.'">
Наша доставка на floristum.ru
</a>',
                        '<a href="'.$href.'">
<img src="'.$src.'" alt="цветы с доставкой в '.$shop->city->name_prepositional.'">
Наша витрина на  floristum.ru
</a>',
                ];

                return view('admin.shop.partnership', [
                        'bannerCode' => $banners[rand(0,4)],
                        'shop' => $shop,
                        'banner' => $banner
                ]);
        }

        public function partnershipAdd(Request $request) {
                $route = 'shops.partnership';

                if(empty($request->url)) {
                        \Session::flash('layoutWarning', ['type' => 'warning', 'text' => 'Введите правильный адрес страницы']);
                } else {

                        if($this->user->admin && !empty($request->shop_id)) {
                                $banner = new Banner();
                                $banner->shop_id = $request->shop_id;

                                $route = 'shops.partnership.list';
                        } else {
                                $shop = $this->user->getShop();

                                $banner = Banner::where('shop_id', $shop->id)->first();

                                if(empty($banner)) {
                                        $banner = new Banner();
                                        $banner->shop_id = $shop->id;
                                }
                        }

                        $banner->url = $request->url;
                        $banner->checked_on = null;
                        $banner->save();

                        \Session::flash('layoutWarning', ['type' => 'success', 'text' => 'Адрес страницы, на которой размещен код кнопки, успешно сохранен! После успешной проверки ссылки, Ваши товары будут иметь преимущество в выводе на Floristum.ru']);
                }

                return redirect()->route($route);
        }

        public function partnershipList() {
                $banners = Banner::get();

                return view('admin.shop.partnership-list', [
                        'banners' => $banners
                ]);
        }

        public function getReport($id, Request $request) {

                $shop = Shop::with(['users'])->findOrFail($id);
                $user_id = $this->user->id;

                if(!$this->user->admin) {
                        $user_shop = $this->user->getShop();
                        if($user_shop->id != $shop->id) {
                                return response()->json([
                                        'error' => true,
                                        'code'  => 403
                                ], 403);
                        }
                } else {
                        $user_id = $shop->users[0]->id;
                }

                $dompdf = new Dompdf();
                $dompdf->set_option('isRemoteEnabled', true);
                $dompdf->set_option('isHtml5ParserEnabled', true);

                //$date = date('d').' '.\App\Helpers\AppHelper::ruMonth(date('m')).' '.date('Y').' г.';
                //$date = \Carbon::now()->subMonth();
                $date = \Carbon\Carbon::parse($request->reportDate);
                $firstOrder = Order::where('shop_id', $shop->id)->where('payed', 1)->where('payment', '!=', 'cash')->first();

                $view = view('reports.report', [
                        'date' => clone $date,
                        'firstOrder' => $firstOrder,
                        'orders' => Order::where('shop_id', $shop->id)->where('payed_at', '>=', $date->startOfMonth()->format('Y-m-d 00:00:00'))->where('payed_at', '<=', $date->endOfMonth()->format('Y-m-d 23:59:59'))->get(),
                        'shop' => Shop::find($shop->id)
                        //'header' => 'Счет на оплату № '.$order->id.' от '.$date,
                        //'order' => $order
                ])->render();

                //echo $view; exit();

                $dompdf->loadHtml($view, 'UTF-8');

                // (Optional) Setup the paper size and orientation
                //$dompdf->setPaper('A4', 'landscape');

                // Render the HTML as PDF
                $dompdf->render();

                // Output the generated PDF to Browser
                $dompdf->stream('report_'.$shop->id.'_'.$date->format('Y-m').'.pdf');


                exit();
        }

        public function getReportCmd(Request $request) {

                set_time_limit ( 3800 );

                $request->reportDate = '2019-02-13';

                $date = \Carbon\Carbon::parse($request->reportDate);

                $shops = Shop::with(['users'])->whereExists(function ($query) use ($date) {
                        $query->select(\DB::raw(1))
                                ->from('orders')
                                ->whereRaw('orders.shop_id = shops.id')
                                ->where('payed_at', '>=', $date->startOfMonth()->format('Y-m-d 00:00:00'))->where('payed_at', '<=', $date->endOfMonth()->format('Y-m-d 23:59:59'));
                })->get();

                //dd(count($shops));

                foreach($shops as $shop) {

                        //$user_id = $this->user->id;

                        if(!$this->user->admin) {
                                $user_shop = $this->user->getShop();
                                if($user_shop->id != $shop->id) {
                                        return response()->json([
                                                'error' => true,
                                                'code'  => 403
                                        ], 403);
                                }
                        } else {
                                $user_id = $shop->users[0]->id;
                        }

                        $dompdf = new Dompdf();
                        $dompdf->set_option('isRemoteEnabled', true);
                        $dompdf->set_option('isHtml5ParserEnabled', true);

                        //$date = date('d').' '.\App\Helpers\AppHelper::ruMonth(date('m')).' '.date('Y').' г.';
                        //$date = \Carbon::now()->subMonth();

                        $firstOrder = Order::where('shop_id', $shop->id)->where('payed', 1)->where('payment', '!=', 'cash')->first();

                        $view = view('reports.report', [
                                'date' => clone $date,
                                'firstOrder' => $firstOrder,
                                'orders' => Order::where('shop_id', $shop->id)
                                        ->where(function ($query) {
                                                $query->where('payment', '=', 'cash')
                                                        ->where('payed', '=', '1');
                                        })->orWhere(function ($query) use ($date) {
                                                $query->where('payed_at', '>=', $date->startOfMonth()->format('Y-m-d 00:00:00'))->where('payed_at', '<=', $date->endOfMonth()->format('Y-m-d 23:59:59'));
                                        })->get(),
                                'shop' => Shop::find($shop->id)
                                //'header' => 'Счет на оплату № '.$order->id.' от '.$date,
                                //'order' => $order
                        ])->render();

                        //echo $view; exit();

                        $dompdf->loadHtml($view, 'UTF-8');

                        // (Optional) Setup the paper size and orientation
                        //$dompdf->setPaper('A4', 'landscape');

                        // Render the HTML as PDF
                        $dompdf->render();

                        // Output the generated PDF to Browser
                        //$dompdf->stream('report_'.$shop->id.'_'.$date->format('Y-m').'.pdf');

                        $report = new ShopReport();

                        $output = $dompdf->output();

                        $report->shop_id = $shop->id;
                        $report->report_date = $date->startOfMonth()->format('Y-m-d');
                        $report->ext = 'pdf';
                        $report->file = base64_encode($output);
                        $report->save();

                        $report = new ShopReport();

                        unset($date);
                        $date = \Carbon\Carbon::parse($request->reportDate);

                        $report->shop_id = $shop->id;
                        $report->report_date = $date->startOfMonth()->format('Y-m-d');
                        $report->ext = 'docx';
                        $report->file = base64_encode($view);
                        $report->save();
                }


                exit();
        }

        public function getReportFile($id, Request $request) {
                $report = ShopReport::findOrFail($id);

                $shop = $this->user->getShop();

                if($shop->id == $report->shop_id || $this->user->admin) {
                        $fileName = 'report_'.$report->shop_id.'_'.$report->report_date;
                        if($report->ext == 'pdf') {
                                header("Content-type:application/pdf");
                                header("Content-Disposition:attachment;filename=".$fileName.".pdf");
                                header("Pragma: no-cache");
                                header("Expires: 0");
                        } else {
                                header("Content-type: application/vnd.ms-word");
                                header("Content-Disposition: attachment;Filename=".$fileName.".doc");
                                header("Pragma: no-cache");
                                header("Expires: 0");
                        }

                        echo base64_decode($report->file);
                }

                exit();
        }
        
        public function rules() {
                return view('admin.shop.rules', []);
        }
}

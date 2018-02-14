<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelper;
use App\Model\Shop;
use App\Model\ShopAddress;
use App\Model\ShopWorkTime;
use App\Model\ShopWorker;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Image;

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

                return view('admin.shop.profile', [
                        'shop' => $shop
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
                        $perPage = 50;
                        $shop = Shop::with(['users', 'city'])->orderBy('id', 'desc');
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
}

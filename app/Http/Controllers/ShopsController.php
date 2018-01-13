<?php

namespace App\Http\Controllers;

use App\Model\Shop;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Image;

class ShopsController extends Controller
{
    //
        public function profile() {

                return view('admin.shop.profile', [

                ]);
        }

        public function apiProfile() {

                $statusCode = 200;
                $response = [
                        'shop' => []
                ];

                try{
                        $response['shop'] = $this->user->getShop();
                } catch (\Exception $e){
                    $statusCode = 400;
                }finally{
                    return response()->json($response, $statusCode);
                }
        }

        public function uploadLogo(Request $request) {

                $photo = Input::all();

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
                $filename = 'logo_'.$this->user->id.'_'.time().'.'.$extension;
                $filePath = Shop::$fileUrl.$this->user->id.'/';
                $fullFileName = $filePath . $filename;

                if(!file_exists(public_path($filePath))) {
                        \File::makeDirectory(public_path($filePath));
                }

                Image::make($photo)->save( public_path($fullFileName ) );

                $shop = $this->user->getShop();

                $shop->logo = $fullFileName;

                $shop->save();

                return response()->json([
                    'error' => false,
                    'code'  => 200
                ], 200);

        }
}

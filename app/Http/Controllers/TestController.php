<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Shop;
use App\Model\Product;


class TestController extends Controller
{

        public function test() {

                

                return view('front.product.client-comment-form', [

                ]);

                try{
                        \Cloudinary::config(array(
                                "cloud_name" => env('CLOUDINARY_CLOUD_NAME'),
                                "api_key" => env('CLOUDINARY_API_KEY'),
                                "api_secret" => env('CLOUDINARY_API_SECRET')
                        ));
                        $product = Product::with('photos')->find(63704);

                        $shop_id = $product->shop_id;
                        $filePath = Product::$fileUrl.$shop_id.'/';

                        foreach($product->photos as $photo) {

                                $file = public_path($filePath).$photo->photo;


                                if(file_exists($file)) {
                                        $path_parts = pathinfo($file);

                                        $width = $height = 632;

                                        $uploadResponse[$width."x".$height] = \Cloudinary\Uploader::upload(
                                                $file,
                                                array(
                                                        "folder" => $width."x".$height."/".$shop_id,
                                                        "public_id" => $path_parts['filename'],
                                                        "width" => $width,
                                                        "height" => $height,
                                                        "transformation" => array(
                                                                "overlay" => "logo_floristum",
                                                                "width"=>0.9, "gravity"=>"north_east", "opacity"=>70, "effect"=>"brightness:50", "crop"=>"scale"
                                                        )
                                                )
                                        );

                                        $width = $height = 350;

                                        $uploadResponse[$width."x".$height] = \Cloudinary\Uploader::upload(
                                                $file,
                                                array(
                                                        "folder" => $width."x".$height."/".$shop_id,
                                                        "public_id" => $path_parts['filename'],
                                                        "width" => $width,
                                                        "height" => $height,
                                                        "transformation" => array(
                                                                "overlay" => "logo_floristum",
                                                                "width"=>0.9, "gravity"=>"north_east", "opacity"=>70, "effect"=>"brightness:50", "crop"=>"scale"
                                                        )
                                                )
                                        );

                                        $photo->cdn_response = json_encode($uploadResponse);
                                        $photo->save();
                                }
                        }


                        dd($uploadResponse);

                } catch(\Exception $e) {
                        print_r($e);
                }
        }

}
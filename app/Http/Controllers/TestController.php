<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Shop;
use App\Model\Product;
use App\User;


class TestController extends Controller
{
        function sendNotification($to = '', $data = []) {
                $apiKey = 'AAAAS3WGJYU:APA91bEiqtnQ853Yb6VdbZem_Ygr9QlhMw1lZMP6iqCN-1HvT0MNKyEn8tcGtvijg03oCScEkhSyX6LEPidUdUyc6y17QuZkDX6DFIkEPhyD0LENwKkxhfv9qSZRlajL8EpOAS5vWUn6';
                $fields = [
                        'to' => $to,
                        'notification' => $data
                ];

                $headers = [
                        'Authorization: key='.$apiKey,
                        'Content-type: Application/json'
                ];

                $url = 'https://fcm.googleapis.com/fcm/send';

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
                $result = curl_exec($ch);
                curl_close($ch);

                return json_decode($result);
        }

        public function test() {

                $users = User::whereHas('shops', function ($query)  {
                        $query->where('city_id', 642790);
                })->whereNotNull('firebase_token')->get();

                dd($users);
                
                foreach($users as $user) {
                        $this->sendNotification($user->firebase_token,
                                [
                                        'title' => 'Свободный заказ',
                                        'body' => 'Пояавился свободный заказ №',
                                ]
                        );
                }

                dd($users);

                dd($this->sendNotification('cZTiB3qk56U:APA91bFSzLMkKL--z2GdSwGtQbxe67TaJJXUkOFbe6fs5QX5pAjteR5_BYwNpxxhz0TvX1ovbGoLYkBhzENs8q2B2rmtroXfjR_yYnGTjaih1Hupzue47fzc5aDXVOVQ2-LdHjDflFhY',
                        [
                                'title' => 'Новый заказ',
                                'body' => 'Приймите заказ №30255',
                        ]
                ));

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
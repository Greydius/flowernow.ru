<?php

namespace App\Console\Commands;

use App\Model\Product;
use Illuminate\Console\Command;

class PhotoCdn extends Command
{
        /**
         * The name and signature of the console command.
         *
         * @var string
         */
        protected $signature = 'photo:cdn';

        /**
         * The console command description.
         *
         * @var string
         */
        protected $description = 'Command description';

        /**
         * Create a new command instance.
         *
         * @return void
         */
        public function __construct()
        {
                parent::__construct();
        }

        /**
         * Execute the console command.
         *
         * @return mixed
         */
        public function handle()
        {
                \Cloudinary::config(array(
                        "cloud_name" => env('CLOUDINARY_CLOUD_NAME'),
                        "api_key" => env('CLOUDINARY_API_KEY'),
                        "api_secret" => env('CLOUDINARY_API_SECRET')
                ));

                $products = Product::with(['photos'])->whereNull('single')
                        ->whereHas('photos', function ($query) {
                                $query->whereNull('cdn_response');
                        })->take(10)->get();

                foreach($products as $product) {
                        //$product = Product::with('photos')->find(63704);

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
                                                        "height" => $height
                                                )
                                        );

                                        $width = $height = 350;

                                        $uploadResponse[$width."x".$height] = \Cloudinary\Uploader::upload(
                                                $file,
                                                array(
                                                        "folder" => $width."x".$height."/".$shop_id,
                                                        "public_id" => $path_parts['filename'],
                                                        "width" => $width,
                                                        "height" => $height
                                                )
                                        );

                                        $photo->cdn_response = json_encode($uploadResponse);
                                        $photo->save();
                                }
                        }
                }


        }
}
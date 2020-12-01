<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Model\Product;
use App\Model\Shop;

class ProductFillShopInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:fillShopInfo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fill Products by shops info';

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
        $products = Product::all();

        foreach($products as $product) {
            $shop = $product->shop;
            if($shop) {
                $product->shop_city_id = $shop->city_id;
                $product->shop_delivery_price = $shop->delivery_price;
                $product->shop_delivery_time = $shop->delivery_time;
                $product->shop_delivery_out = $shop->delivery_out;
                $product->shop_delivery_out_max = $shop->delivery_out_max;
                $product->shop_delivery_out_price = $shop->delivery_out_price;
                $product->shop_active = $shop->active;
                $product->shop_delivery_free = $shop->delivery_free;
                $product->shop_copy_id = $shop->copy_id;

                $product->save();

                $this->info($product->name);
            } else {
                $product->delete();
                $this->error($product->name);
            }
            
        }

        $this->info("Готово");
    }
}

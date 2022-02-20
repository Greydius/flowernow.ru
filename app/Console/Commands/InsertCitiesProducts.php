<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Model\City;
use App\Model\Shop;
use App\Model\Product;

class InsertCitiesProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cities:products';

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
        $mainShop = Shop::find(350);
        $cities = City::orderBy('population', 'DESC')->get();

        $mainProducts = $mainShop->products;

        foreach($cities as $k => $city) {
            $fakeShop = Shop::where('copy_id', 350)->where('city_id', $city->id)->first();

            foreach($mainProducts as $mainProduct) {
                $fakeProduct = new Product($city->order, $mainProduct->toArray());

                $fakeProduct->copy_id = $mainProduct->id;

                $fakeProduct->save();

                $this->info($city->order);
            }

            $this->info($fakeShop->id . ': ' .str_slug($city->name));
        }
    }
}

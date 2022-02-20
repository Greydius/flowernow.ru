<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\Hash;

use App\Model\City;
use App\Model\Shop;
use App\User;

class FakeCitiesShops extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fake:shops';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create fake shops to all cities';

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

            $fakeShop = $mainShop->replicate();
            $fakeShop->city_id = $city->id;
            $fakeShop->email = $city->slug . '-shop@floristum.com';
            $fakeShop->phone = "+79618" . str_pad($city->id, 6, "0", STR_PAD_LEFT);
            $fakeShop->name = $city->name . 'ФЛ';
            $fakeShop->copy_id = 350;
            $fakeShop->balance = 0;

            $fakeShop->save();

            $fakeProducts = [];

            foreach($mainProducts as $mainProduct) {
                $fakeProduct = $mainProduct->replicate();
                $fakeProduct->copy_id = $mainProduct->id;
                $fakeProducts[] = $fakeProduct;
            }

            $fakeShop->products()->saveMany($fakeProducts);

            $user = new User([
                "name" => "Сотрудник " . $fakeShop->name,
                "email" => $fakeShop->email,
                "phone" => $fakeShop->phone,
                "password" => Hash::make("InterActive123!")
            ]);

            $fakeShop->users()->save($user);

            $this->info($fakeShop->id . ': ' .str_slug($city->name));
        }
        
    }
}

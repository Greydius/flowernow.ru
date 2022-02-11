<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Model\Order;
use App\Model\Shop;

class SetOrderShopName extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:setName';

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
        $orders = Order::all();
        foreach($orders as $order) {
            if($order->shop && $order->shop->city && $order->shop->city->name) {
                $order->city_name = $order->shop->city->name;
                $order->save();
                $this->info($order->city_name);
            }
            
        }
    }
}

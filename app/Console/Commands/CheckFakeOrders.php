<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Model\Order;
use Illuminate\Database\Eloquent\Builder;

class CheckFakeOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:checkFake';

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
        $orders = Order::whereHas('shop', function(Builder $query) {
            $query->where('name', 'LIKE', '%ФЛ')->where('status', '!=', 'completed');
        })->get();

        $products = [];

        foreach($orders as $k => $order) {
            $this->info($k . '. ' . $order->id . ' - ' . $order->shop->name . ' - ' . $order->receiving_date);
            foreach($order->orderLists as $orderList) {
                $products[] = $orderList->product_id;
                $this->info($orderList->product_id);
            }
        }
        $this->info(count($products));
    }
}

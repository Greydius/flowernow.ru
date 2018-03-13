<?php

namespace App\Console\Commands;

use App\Model\Order;
use App\Helpers\Sms;
use Illuminate\Console\Command;

class CheckOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:check';

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
        //
            $now = time();
            $date5min_start = date('Y-m-d H:i:00', $now - 5*60);
            $date5min_end = date('Y-m-d H:i:00', $now - 4*60);

            $orders = Order::where('payed_at', '>=', $date5min_start)->where('payed_at', '<', $date5min_end)->where('status', 'new')->get();

            if(!empty($orders)) {
                    foreach ($orders as $order) {
                            $shop = $order->shop;
                            if ($shop->phone) {
                                    $link = \Autologin::route($shop->users[0], 'admin.orders');
                                    try {
                                            $shortLink = \App\Helpers\AppHelper::urlShortener($link)->id;
                                    } catch (\Exception $e) {
                                            $shortLink = $link;
                                    }
                                    //Sms::instance()->send($shop->phone, 'Примите заказ за 10 минут ' . $shortLink);
                                    Sms::instance()->send($shop->phone, 'Примите заказ за 10 минут ' . $shortLink);
                            }
                    }
            }

            /*
            $now = time();
            $date5min_start = date('Y-m-d H:i:00', $now - 15*60);
            $date5min_end = date('Y-m-d H:i:00', $now - 14*60);

            $orders = Order::where('payed_at', '>=', $date5min_start)->where('payed_at', '<', $date5min_end)->where('status', 'new')->get();

            if(!empty($orders)) {
                    foreach ($orders as $order) {
                            $shop = $order->shop;
                            if ($shop->phone) {
                                    $link = \Autologin::route($shop->users[0], 'admin.orders');
                                    try {
                                            $shortLink = \App\Helpers\AppHelper::urlShortener($link)->id;
                                    } catch (\Exception $e) {
                                            $shortLink = $link;
                                    }
                                    //Sms::instance()->send($shop->phone, 'Примите заказ за 10 минут ' . $shortLink);
                                    Sms::instance()->send($shop->phone, 'Примите заказ или он будет отменен! ' . $shortLink);
                            }
                    }
            }
            */

            $this->info($date5min_start);
            $this->info($date5min_end);


    }
}

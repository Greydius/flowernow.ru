<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Model\Shop;

class FixShopToShopProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:shop_to_shop_copy';

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
        $shops = Shop::whereNull('copy_id')->get();
        $kkk = 0;
        foreach($shops as $k => $shop) {
            foreach($shop->products as $kk => $product) {
                if(!str_contains($product->photo, 'p' . $product->shop_id)) {
                    $kkk++;
                    $this->info($kkk . ' ' . $product->photo . ' - p' . $product->shop_id);
                    break;
                }
            }
            
        }

    }
}

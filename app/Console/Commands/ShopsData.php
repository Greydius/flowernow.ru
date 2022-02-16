<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Model\Shop;


class ShopsData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shops:data';

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
        $shops = Shop::where('active', true)->where('name', 'not like', '%ФЛ')->get();

        foreach($shops as $k => $shop) {
            $this->info($shop->name . ';' . $shop->city->name . ';' . count($shop->orders) . ';' . $shop->users[0]->phone);
        }
    }
}

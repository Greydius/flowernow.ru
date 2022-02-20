<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Model\City;

class AddOrderToCities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cities:order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add order to cities';

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
        $cities = City::all();

        foreach($cities as $k => $city) {
            $order = ceil( ($k+1) / 100 );

            $city->order = $order;

            $city->save();

            $this->info($city->name);
        }
    }
}

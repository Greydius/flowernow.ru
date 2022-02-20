<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Model\City;

class CitiesNames extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cities:names';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update names in dublicates';

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
        $cities = City::where('slug', 'like', '%--%')->get();

        foreach($cities as $city) {

            $name = $city->name;

            $reqion = $city->region->name;

            $city->name = $name . " (" . $reqion . ")";

            $city->save();

            $this->info($city);
        }
    }
}

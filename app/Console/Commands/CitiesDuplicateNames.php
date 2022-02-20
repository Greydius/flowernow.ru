<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Model\City;

class CitiesSlug extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cities:duplicates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update duplicate names in dublicates';

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

            $clearName = explode(" (", $city->name);

            $copy = City::where('name', $clearName[0])->first();

            if($copy) {
                $name = $copy->name;
                $region = $copy->region->name;
                
                $copy->name = $name . " (" . $region . ")";

                $copy->save();

                $this->info($copy->name);
            }
        }
    }
}


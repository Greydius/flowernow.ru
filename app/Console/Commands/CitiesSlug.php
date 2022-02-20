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
    protected $signature = 'cities:slugs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Slugs to cities';

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
        $cities = City::whereNull('slug')->get();

        foreach($cities as $city) {
            $city_slug = str_slug($city->name);

            $has_duplicate = City::where('slug', $city_slug)->first();

            if($has_duplicate) {
                $city_slug = $city_slug . '--' . str_slug($city->region->name);
                $city->with_region = 1;
            }

            $city->slug = $city_slug;

            $city->save();

            $this->info($city_slug);
        }
    }
}

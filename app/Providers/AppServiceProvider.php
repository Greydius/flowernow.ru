<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
            Schema::defaultStringLength(191);


            if (Schema::hasTable('settings')) {
                    foreach (\App\Model\Setting::all() as $setting) {
                            \Config::set('settings.' . $setting->key, $setting->value);
                    }
            }

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

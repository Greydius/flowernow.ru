<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

use App\Model\City;
use App\Model\TodayCountProduct;

class TodayCountProductsController extends Controller
{
        public function update()
        {
                $cities = City::whereNotNull('slug')->get();

                foreach($cities as $city) {
                  TodayCountProduct::updateOrCreate(
                    ['city_id' => $city->id],
                    ['count' => $city->total_products]
                  );
                }

                return 'success';
        }
}

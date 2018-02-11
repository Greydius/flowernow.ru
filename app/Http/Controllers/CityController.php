<?php

namespace App\Http\Controllers;

use App\Model\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
        public function popular() {
                $cities = City::popular(0, true);

                return view('front.city.popular',[
                        'cities' => $cities,
                ]);
        }
}
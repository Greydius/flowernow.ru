<?php

namespace App\Http\Controllers;

use App\Model\City;
use App\Model\Region;
use Illuminate\Http\Request;

class CityController extends Controller
{
        public function popular() {
                $cities = City::popular(0, false);

                return view('front.city.popular',[
                        'cities' => $cities,
                ]);
        }

        public function choosePopup() {

                $cities = City::whereNotNull('slug')->get();

                $regions = Region::whereHas('cities', function($query){
                        $query->whereNotNull('slug');
                })->get();

                return view('front.city.choose-popup',[
                        'regions' => $regions,
                        'cities' => $cities
                ]);
        }
}
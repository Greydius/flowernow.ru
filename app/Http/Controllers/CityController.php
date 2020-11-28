<?php

namespace App\Http\Controllers;

use App\Model\City;
use App\Model\Region;
use Illuminate\Http\Request;

class CityController extends Controller
{
        public function popular(Request $request) {
                //$cities = City::popular(0, false);
                $citiesQ = City::orderby('name');

                $spell = $request->spell;
                if($spell) {
                    $citiesQ->where('name', 'like', $spell . '%');
                } else {
                    $citiesQ->where('name', 'like', 'А%');
                }

                $cities = $citiesQ->get();

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
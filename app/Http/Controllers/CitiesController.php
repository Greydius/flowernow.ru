<?php

namespace App\Http\Controllers;

use App\Model\City;
use Illuminate\Http\Request;

class CitiesController extends Controller
{
    //
        public function search(Request $request) {

                $cities = [];

                if(!empty($request->txt) && mb_strlen($request->txt) >= 2) {
                        $cities = City::where('name', 'like', $request->txt.'%')->orderBy('population', 'desc')->with('region')->get();

                        /*
                        return $cities;
                        if(!empty($cities)) {
                                foreach ($cities as $city) {
                                        echo $city->region->name;
                                        exit();
                                }
                        }
                        */
                }

                return response()->json($cities);
        }

        public function cities(Request $request) {
          $cities = City::whereNotNull('slug')->orderBy('population', 'DESC')->get();
          
          $citiesString = "";

          foreach($cities as $city) {
            $citiesString .= $city->slug . "|";
          }
          return $citiesString;
        }
}

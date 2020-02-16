<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use App\Model\City;

class ApiController extends Controller
{
        public function cities(Request $request)
        {

                
                $cities = City::whereNotNull('slug')->with(['region'])->orderBy('population', 'DESC')->get();

                return $cities;
        }
}
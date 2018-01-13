<?php

namespace App\Http\Controllers;

use App\Model\City;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $user;
    protected $city_id;

    public function __construct() {
            $this->user = null;
            $this->current_city = null;

            $this->middleware(function ($request, $next) {

                    $cookieCityId = !empty($_COOKIE['city']) ? $_COOKIE['city'] : null;

                    if(empty($cookieCityId) || (!empty($this->current_city) && $cookieCityId != $this->current_city->id)) {

                            try{
                                    $location = \SypexGeo::get(request()->ip());
                                    $this->current_city = City::where('name', $location['city']['name_ru'])->first();
                            }
                            catch(\Exception $e){

                            }

                    } else {
                            //637640 - id мск
                            $ids = [(int)$cookieCityId, 637640];
                            $this->current_city = City::whereIn('id',$ids)->orderByRaw("FIELD(id, ".implode(',', $ids).")")->first();
                    }

                    View::share('current_city', $this->current_city);

                    $this->user = Auth::user();
                    View::share('user', $this->user);

                    if($this->user) {
                            View::share('shop', $this->user->getShop());
                    }

                    return $next($request);
            });

    }
}

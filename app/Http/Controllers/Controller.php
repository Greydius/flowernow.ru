<?php

namespace App\Http\Controllers;

use App\Model\City;
use App\Model\Agent;
use App\Model\ProductType;
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
    protected $holiday_icon;

    public function __construct() {
            $this->user = null;
            $this->current_city = [];
            $this->holiday_icon = null;

            $this->middleware(function ($request, $next) {

                    if((time() >= strtotime(date('Y-12-15 00:00:00')) && time() <= strtotime(date('Y-12-31 23:59:59'))) ||
                            (time() >= strtotime(date('Y-01-01 00:00:00')) && time() <= strtotime(date('Y-01-20 23:59:59')))) {
                            $this->holiday_icon[] = 'mob1';
                            $this->holiday_icon[] = 'pc4';
                    }

                    if(time() >= strtotime(date('Y-02-01 00:00:00')) && time() <= strtotime(date('Y-02-14 23:59:59'))) {
                            $this->holiday_icon[] = 'mob2';
                            $this->holiday_icon[] = 'pc3';
                    }

                    if(time() >= strtotime(date('Y-02-28 23:59:59')) && time() <= strtotime(date('Y-02-09 23:59:59'))) {
                            $this->holiday_icon[] = 'mob3';
                            $this->holiday_icon[] = 'pc2';
                    }

                    if(time() >= strtotime(date('Y-08-20 00:00:00')) && time() <= strtotime(date('Y-09-01 23:59:59'))) {
                            $this->holiday_icon[] = 'mob4';
                            $this->holiday_icon[] = 'pc1';
                    }

                    $cookieCityId = !empty($_COOKIE['city']) ? $_COOKIE['city'] : null;

                    $this->current_city = $request->_city;

                    $this->detected_city = null;

                    if(empty($cookieCityId)) {

                            try{
                                    $location = \SypexGeo::get(request()->ip());
                                    $this->detected_city = City::where('name', $location['city']['name_ru'])->with(['region'])->first();

                                    if(empty($this->detected_city)) {
                                            $ids = [(int)$cookieCityId, 637640];
                                            $this->detected_city = City::whereIn('id',$ids)->with(['region'])->orderByRaw("FIELD(id, ".implode(',', $ids).")")->first();
                                    }
                            }
                            catch(\Exception $e){

                                    $ids = [(int)$cookieCityId, 637640];
                                    $this->detected_city = City::whereIn('id',$ids)->with(['region'])->orderByRaw("FIELD(id, ".implode(',', $ids).")")->first();
                            }

                            setcookie('city', $this->detected_city->id, time() + (86400 * 30), "/", \Config::get('app.domain'));

                    }

                    try{
                            $agent = Agent::where('city_id', $this->current_city->id)->with('shop.address')->first();
                            View::share('globalAgent', $agent);
                    }
                    catch(\Exception $e){
                    }

                    View::share('detected_city', $this->detected_city);
                    //View::share('_productTypes', ProductType::where('show_on_main', '1')->orderBy('priority')->get());

                    View::share('_productTypes', ProductType::where('show_on_main', '1')->inCity($this->current_city->id)->orderBy('priority')->get());
                    View::share('_flowers', \App\Model\Flower::orderBy('popularity', 'desc')->limit(9)->get());
                    View::share('_prices', \App\Model\Price::all());
                    View::share('_colors', \App\Model\Color::all());


                    /*
                    if(empty($cookieCityId) || (!empty($this->current_city) && $cookieCityId != $this->current_city->id)) {

                            try{
                                    $location = \SypexGeo::get(request()->ip());
                                    $this->current_city = City::where('name', $location['city']['name_ru'])->first();

                                    if(empty($this->current_city)) {
                                            $ids = [(int)$cookieCityId, 637640];
                                            $this->current_city = City::whereIn('id',$ids)->orderByRaw("FIELD(id, ".implode(',', $ids).")")->first();
                                    }
                            }
                            catch(\Exception $e){

                                    $ids = [(int)$cookieCityId, 637640];
                                    $this->current_city = City::whereIn('id',$ids)->orderByRaw("FIELD(id, ".implode(',', $ids).")")->first();
                            }

                    } else {
                            //637640 - id мск
                            $ids = [(int)$cookieCityId, 637640];
                            $this->current_city = City::whereIn('id',$ids)->orderByRaw("FIELD(id, ".implode(',', $ids).")")->first();
                    }

                    View::share('current_city', $this->current_city);

                    */

                    View::share('current_city', $this->current_city);
                    //$popular_city = City::$popular;
                    $popular_city = City::popular(0, false);
                    //shuffle($popular_city);
                    //View::share('popular_city', array_slice($popular_city, 11));
                    View::share('popular_city', $popular_city);

                    $this->user = Auth::user();
                    View::share('user', $this->user);
                    View::share('holiday_icon', $this->holiday_icon);

                    if($this->user) {
                            View::share('shop', $this->user->getShop());
                    }

                    return $next($request);
            });

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\City;
use App\Model\Shop;
use App\Model\Agent;

class AgentsController extends Controller
{
    //

        public function index()
        {
                //
                $cities = City::where('population', '>', 0)
                        ->whereNotNull('slug')
                        ->orderBy('population', 'DESC')
                        ->with('agent.shop.address')
                        ->get();

                return view('admin.agents.list', [
                        'cities' => $cities
                ]);
        }

        public function edit($city_id) {
                $city = City::findOrFail($city_id);
                $shops = Shop::where('city_id', $city_id)->orderBy('name')->get();
                $agent = Agent::where('city_id', $city_id)->first();

                return view('admin.agents.edit', [
                        'city' => $city,
                        'shops' => $shops,
                        'agent' => $agent
                ]);
        }

        public function update($city_id, Request $request) {
                $city = City::findOrFail($city_id);

                $agent = Agent::where('city_id', $city_id)->first();

                if(empty($request->shop_id)) {
                        \Session::flash('layoutWarning', ['type' => 'warning', 'text' => 'Выберите магазин']);

                        return redirect()->route('admin.agent.edit', ['city_id' => $city_id]);
                }

                if(empty($agent)) {
                        $agent = new Agent();
                }

                $agent->city_id = $city->id;
                $agent->shop_id = empty($request->shop_id) ? null : $request->shop_id;
                $agent->webmaster = empty($request->webmaster) ? null : $request->webmaster;

                $agent->save();

                \Session::flash('layoutWarning', ['type' => 'success', 'text' => 'Данные партнера успешно изменены']);

                return redirect()->route('admin.agents.list');
        }
}

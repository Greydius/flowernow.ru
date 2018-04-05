<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelper;
use Illuminate\Http\Request;
use App\Model\Subscription;

class SubscriptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
            $subscriptions = Subscription::get();

            return view('admin.subscription.index', [
                    'subscriptions' => $subscriptions
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type = null)
    {
        //
            $cities = \DB::select("SELECT c.name, fc.city_id, fc.region FROM cities c
              INNER JOIN f_city fc ON fc.city = c.name
              WHERE c.population > 0");

            return view((empty($type) ? 'admin.subscription.create' : 'admin.subscription.create_every_day'), [
                    'cities' => $cities
            ]);
    }

    public function create2($type = '')
    {
        //
            return $this->create('every_day');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
            if(empty($request->cities)) {
                    \Session::flash('layoutWarning', ['type' => 'warning', 'text' => 'Выберите хотя бы один город']);
                    return back();
            }

            if(empty($request->name)) {
                    \Session::flash('layoutWarning', ['type' => 'warning', 'text' => 'Введите название']);
                    return back();
            }

            if(empty($request->message)) {
                    \Session::flash('layoutWarning', ['type' => 'warning', 'text' => 'Введите Сообщение']);
                    return back();
            }

            $subscription = new Subscription();
            $subscription->name = $request->name;
            $subscription->parameters = json_encode([
                    'cities' => $request->cities
            ]);
            $subscription->message = $request->message;

            if(!empty($request->start_time)) {
                    $subscription->start_time = $request->start_time;
            }

            $subscription->save();

            return redirect()->route('admin.subscription.index');
    }

    public function run(Request $request)
    {
            if(empty($request->id)) {
                    return back();
            }

            $subscription = Subscription::findOrFail($request->id);

            $subscription->active = 1;

            if($subscription->save()) {
                    if(!$subscription->start_time) {
                            $subscription->run();
                    }
            }

            return back();
    }

    public function pause(Request $request)
    {
            if(empty($request->id)) {
                    return back();
            }

            $subscription = Subscription::findOrFail($request->id);

            $subscription->active = 0;

            if($subscription->save()) {
            }

            return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

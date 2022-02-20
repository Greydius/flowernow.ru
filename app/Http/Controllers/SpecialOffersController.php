<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\SpecialOffer;

class SpecialOffersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
            $specialOffers = SpecialOffer::all();
            return view('admin.special_offers.index', [
                    'specialOffers' => $specialOffers
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
            return view('admin.special_offers.create', []);
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
            SpecialOffer::create($request->all());
            return redirect()->route('admin.specialOffers.list');
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
            $specialOffer = SpecialOffer::findOrFail($id);
            return view('admin.special_offers.edit', [
                    'specialOffer' => $specialOffer
            ]);
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
            $specialOffer = SpecialOffer::findOrFail($id);
            $specialOffer->update($request->all());
            return redirect()->route('admin.specialOffers.list');

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
            SpecialOffer::destroy($id);
            return redirect()->route('admin.specialOffers.list');
    }
}

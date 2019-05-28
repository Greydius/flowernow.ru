<?php

namespace App\Http\Controllers;

use App\Model\Direct;
use App\Model\City;
use App\Model\Flower;
use App\Model\Product;
use Illuminate\Http\Request;

class DirectController extends Controller {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index(Request $request) {
                //
                $cities = City::has('shops')->orderBy('name', 'asc')->get();
                $directs = Direct::get();
                $direct_url = [];
                $city = null;

                if(!empty($request->cityId)) {
                        $city = City::where('id', $request->cityId)->first();

                        foreach($directs as $direct) {
                                $directData = json_decode($direct->data);
                                $queries = explode('/', $direct->url);
                                $request->flowers = [];
                                if(count($queries) == 3) {
                                        $request->product_type = $queries[1];
                                        $request->product_type_filter = $request->product_type;
                                        if($queries[2] != 'vse-cvety') {
                                                $flower = Flower::where('slug', $queries[2])->first();
                                                if(count($flower)) {
                                                        $request->flowers = array_merge($request->flowers, [$flower->id]);
                                                }
                                        }

                                        //$request->flowers = array_merge($request->flowers, [$flower->id]);

                                        $checked = false;

                                        if(!empty($directData)) {
                                                foreach($directData as $data) {
                                                        if($data->cityId == $city->id && !empty($data->direct_check)) {
                                                                $checked = true;
                                                        }
                                                }
                                        }

                                        $request->test = 1;


                                        $direct_url[] = [
                                                'id' => $direct->id,
                                                'url' => $direct->url,
                                                'products_count' => Product::popular($city->id, $request, 1, 36)->total(),
                                                'checked' => $checked
                                        ];

                                }
                        }
                }

                return view('admin.direct.list',[
                        'city' => $city,
                        'cities' => $cities,
                        'directs' => $directs,
                        'direct_url' => $direct_url
                ]);
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create() {
                //
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request $request
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request) {
                //
        }

        /**
         * Display the specified resource.
         *
         * @param  \App\Model\Direct $direct
         * @return \Illuminate\Http\Response
         */
        public function show(Direct $direct) {
                //
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  \App\Model\Direct $direct
         * @return \Illuminate\Http\Response
         */
        public function edit(Direct $direct) {
                //
        }

        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request $request
         * @param  \App\Model\Direct $direct
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, Direct $direct) {
                //

                if(!empty($direct)) {
                        $directData = [];

                        if(!empty($direct->data)) {
                                $directData = json_decode($direct->data);
                                $exist = false;
                                foreach($directData as $key => &$data) {
                                        if($data->cityId == $request->cityId) {
                                                if(empty($request->direct_check)) {
                                                        unset($directData[$key]);
                                                        break;
                                                } else {
                                                        $data->direct_check = 1;
                                                }

                                                $exist = true;
                                        }
                                }

                                if(!$exist && !empty($request->direct_check)) {
                                        $obj = new \stdClass();
                                        $obj->cityId = $request->cityId;
                                        $obj->direct_check = 1;
                                        $directData[] = $obj;
                                }
                        } elseif(!empty($request->direct_check)) {
                                $obj = new \stdClass();
                                $obj->cityId = $request->cityId;
                                $obj->direct_check = 1;
                                $directData[] = $obj;
                        }

                        $direct->data = json_encode($directData);
                        $direct->save();
                }
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  \App\Model\Direct $direct
         * @return \Illuminate\Http\Response
         */
        public function destroy(Direct $direct) {
                //
        }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\PromoCode;
use App\Model\Product;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Sms;

class PromoCodesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
            //echo PromoCode::getNewCode(); exit();
            return view('admin.promo_codes.create', [
                    'promoCodes' => PromoCode::where('reusable', 1)->get()
            ]);
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
            $validator = Validator::make($request->all(), PromoCode::$rules, PromoCode::$rulesMessages);

            if ($validator->fails()) {

                    return response()->json([
                            'error' => true,
                            'message' => $validator->messages()->first(),
                            'code' => 400
                    ], 400);

            }

            $promo_code = PromoCode::getNewCode();

            $promoCode = new PromoCode();
            $promoCode->code = $promo_code;
            $promoCode->code_type = $request->code_type;
            $promoCode->value = $request->value;
            $promoCode->reusable = !empty($request->reusable) ? 1 : 0;

            if($promoCode->save()) {

                    try {
                            if($request->send && !empty($request->phone) && !empty($request->msg)) {
                                    Sms::instance()->send($request->phone, str_replace('[promo]', $promo_code, $request->msg));
                            }
                    } catch (\Exception $e) {

                    }

                    return response()->json([
                            'error' => false,
                            'promo' => $promo_code
                    ], 200);
            }


            return response()->json([
                    'error' => true,
                    'message' => 'Ошибка',
                    'code' => 400
            ], 400);
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
            PromoCode::destroy($id);

            return back();
    }

    public function getInfo(Request $request) {
            if(!empty($request->code)) {
                    $promoCode = PromoCode::where('code', $request->code)->first();

                    if(empty($promoCode)) {
                            return response()->json([
                                    'error' => true,
                                    'message' => 'Промо код не найден'
                            ], 400);
                    } elseif(!empty($promoCode->used_on) && !$promoCode->reusable) {
                            return response()->json([
                                    'error' => true,
                                    'message' => 'Промо код уже использован'
                            ], 400);
                    } else {
                            $product = Product::with('shop.city')->with('compositions.flower')->findOrFail($request->productId);
                            $product->setPromoCode($request->code);
                            return response()->json([
                                    'error' => false,
                                    'product' => $product,
                                    'promo' => $promoCode
                            ], 200);
                    }
            }

            return response()->json([
                    'error' => true,
                    'message' => 'Промо код не найден'
            ], 400);
    }
}

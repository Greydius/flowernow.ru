<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Product;
use App\Model\Feedback;
use App\Model\Shop;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
            $feedbacks = Feedback::select('feedback.*')->join('shops', 'shops.id', '=', 'feedback.shop_id')->with('shop.city')->with('product')->orderBy('shops.city_id')->orderBy('feedback.shop_id')->orderBy('feedback.id', 'desc')->get();
            return view('admin.feedback.list', [
                    'feedbacks' => $feedbacks
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
            $shops = Shop::with('city')->get();
            return view('admin.feedback.create', [
                    'shops' => $shops
            ]);
    }

    public function shop_products(Request $request) {
            $products = Product::where('shop_id', (int)$request->shop_id)->get();
            return response()->json([
                    'products' => $products,
            ], 200);
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
            if(!empty($request->shop_id) && !empty($request->name) && !empty($request->feedback_text)) {
                    $feedback = new Feedback();
                    $feedback->shop_id = $request->shop_id;
                    $feedback->product_id = !empty($request->product_id) ? $request->product_id : null;
                    $feedback->rating = $request->rating;
                    $feedback->name = $request->name;
                    $feedback->feedback = $request->feedback_text;
                    $feedback->feedback_date = $request->feedback_date;
                    $feedback->save();
            }
            
            return redirect()->route('admin.feedback.list');
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
            $feedback = Feedback::findOrFail($id);
            $shops = Shop::with('city')->get();
            return view('admin.feedback.create', [
                    'shops' => $shops,
                    'feedback' => $feedback
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
            $feedback = Feedback::findOrFail($id);
            $feedback->shop_id = $request->shop_id;
            $feedback->product_id = !empty($request->product_id) ? $request->product_id : null;
            $feedback->rating = $request->rating;
            $feedback->name = $request->name;
            $feedback->feedback = $request->feedback_text;
            $feedback->feedback_date = $request->feedback_date;
            $feedback->save();

            return redirect()->route('admin.feedback.list');
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
            $feedback = Feedback::findOrFail($id);
            $feedback->delete();
            return redirect()->route('admin.feedback.list');
    }
}

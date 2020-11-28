<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Product;
use App\Model\Order;
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
            $feedbacks = Feedback::select('feedback.*')
                    ->join('shops', 'shops.id', '=', 'feedback.shop_id')
                    ->with('shop.city')->with('product')
                    ->orderBy('shops.city_id')
                    ->orderBy('feedback.shop_id')
                    ->orderBy('feedback.id', 'desc')
                    ->whereNull('order_id')
                    ->get();
            return view('admin.feedback.list', [
                    'feedbacks' => $feedbacks
            ]);
    }

        public function real()
        {
                //
                $feedbacks = Feedback::select('feedback.*')
                        ->join('shops', 'shops.id', '=', 'feedback.shop_id')
                        ->with('shop.city')->with('product')->with('order.orderLists.product')
                        ->orderBy('shops.city_id')
                        ->orderBy('feedback.shop_id')
                        ->orderBy('feedback.id', 'desc')
                        ->whereNotNull('order_id')
                        ->get();
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
                    $feedback->approved = !empty($request->approved) ? 1 : 0;
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
            $feedback->approved = !empty($request->approved) ? 1 : 0;
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

        public function unapprove($id)
        {
                //
                $feedback = Feedback::findOrFail($id);
                $feedback->approved = 0;
                $feedback->save();
                return redirect()->back();
        }

        public function approve($id)
        {
                //
                $feedback = Feedback::findOrFail($id);
                $feedback->approved = 1;
                $feedback->save();
                return redirect()->back();
        }

    public function reviews() {
            $perPage = 10;
            $feedbacks = Feedback::whereHas('shop', function ($query) {
                            $query->where('city_id', $this->current_city->id);
                    })->paginate($perPage);

            return view('front.feedback.list', [
                    'feedbacks' => $feedbacks
            ]);
    }
    
    public function add($key) {
            
            $order = Order::where('key', $key)->with('orderLists.product')->first();

            if(empty($order) || $order->status != 'completed' || Feedback::where('order_id', $order->id)->count()) {
                    return redirect()->route('front.index');
            }

            return view('front.product.client-comment-form', [
                    'order' => $order,
                    'product' => $order->orderLists[0]->product
            ]);
    }

    public function feedbackCreate($key, Request $request) {
        
        $order = Order::where('key', $key)->first();
        
        if(empty($order) || $order->status != 'completed' || Feedback::where('order_id', $order->id)->count()) {
                return redirect()->route('front.index');
        }

        $feedback = new Feedback();
        $feedback->shop_id = $order->shop_id;
        $feedback->order_id = $order->id;
        $feedback->product_id = null;
        $feedback->name = $order->name;
        $feedback->feedback = $request->feedback;
        $feedback->rating = $request->rating >= 1 && $request->rating <= 5 ? $request->rating : 5;
        $feedback->feedback_date = date('Y-m-d H:i:s');

        if($feedback->save()) {
                $msg = 'В течение суток мы отправим промо-код на скидку по указанному в заказе адресу электронной почты.<br>Если письмо с промо-кодом не пришло, обратитесь в службу поддержки, все контакты указаны на <a href="https://floristum.ru">Floristum.ru</a>';
        } else {
                $msg = 'Ошибка';
        }
        
        return view('front.product.client-comment-form', [
                'msg' => $msg
        ]);
    }
}

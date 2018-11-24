<?php

namespace App\Http\Controllers;

use App\Model\Shop;
use App\Model\Order;
use Illuminate\Http\Request;
use App\Model\Invoice;
use App\Model\Transaction;

class InvoicesController extends Controller
{
    //
        public function index__() {

                if(!$this->user->admin) {
                        return redirect()->route('admin.shop.profile');
                }

                $invoices = Invoice::orderBy('id', 'desc')->get();

                return view('admin.invoices.index',[
                        'invoices' => $invoices
                ]);
        }

        public function index2(Request $request) {

                if(!$this->user->admin) {
                        return redirect()->route('admin.shop.profile');
                }

                $dateFrom = !empty($request->dateFrom) ? $request->dateFrom : '2018-01-01';
                $dateTo = !empty($request->dateTo) ? $request->dateTo : '2118-01-01';

                $perPage = 2000;

                $invoices = Invoice::with(['shop'])->orderBy('id', 'desc')->paginate($perPage);

                $shops = Shop::where('balance', '>', 0)->get();

                foreach ($shops as $shop) {
                        $shop->invoiceAmount = $shop->invoices()->where('realized', '!=', 2)->sum('amount');
                        $shop->totalBalance = $shop->frozenBalance + $shop->availableOutBalance;
                        $shop->total = $shop->totalBalance + $shop->invoiceAmount;
                }

                return view('admin.invoices.index2',[
                        'invoices' => $invoices,
                        'shops' => $shops
                ]);
        }

        public function changeStatus($id, Request $request) {
                $invoice = Invoice::with('shop')->findOrFail($id);

                $status = $request->status;
                $comment = !empty($request->comment) ? $request->comment : null;

                $invoice->realized = $status;
                $invoice->comment = $comment;
                $invoice->save();
        }

        public function index(Request $request) {

                if(!$this->user->admin) {
                        return redirect()->route('admin.shop.profile');
                }

                $dateFrom = !empty($request->dateFrom) ? $request->dateFrom : '2018-01-01';
                $dateTo = !empty($request->dateTo) ? $request->dateTo : '2118-01-01';

                $perPage = 2000;

                $invoicesOld = Invoice::with(['shop'])->where('realized', 1)->orderBy('id', 'desc')->paginate($perPage);
                $invoicesNew = Invoice::with(['shop'])->where('realized', 0)->orderBy('id', 'desc')->paginate($perPage);

                $shops = Shop::where('balance', '>', 0)->get();

                foreach ($shops as $shop) {
                        $shop->invoiceAmount = $shop->invoices()->where('realized', '!=', 1)->sum('amount');
                        $shop->totalBalance = $shop->frozenBalance + $shop->availableOutBalance;
                        $shop->total = $shop->totalBalance + $shop->invoiceAmount;
                }

                $frozenBalance = 0;
                $availableOutBalance = 0;
                $amount = 0;
                $shopUsed = array();
                foreach ($invoicesNew as $invoice) {
                        if(!in_array($invoice->shop->id, $shopUsed)) {
                                $frozenBalance += $invoice->shop->frozenBalance;
                                $availableOutBalance += $invoice->shop->availableOutBalance;
                                $shopUsed[] = $invoice->shop->id;
                        }
                        $amount += $invoice->amount;
                }

                return view('admin.invoices.index3',[
                        'invoicesOld' => $invoicesOld,
                        'invoicesNew' => $invoicesNew,
                        'frozenBalance' => $frozenBalance,
                        'availableOutBalance' => $availableOutBalance,
                        'amount' => $amount,
                        'shops' => $shops
                ]);
        }

        function balance(Request $request) {

                $type = $request->type;
                $shop = Shop::findOrFail($request->shop_id);

                $orders = array();

                switch($type) {
                        case 'frozen':
                                $orderIds = Transaction::where('id', '>', 103)->where('shop_id', $shop->id)->where('action', 'order')->where('amount', '>', 0)->where('created_at', '>=', date('Y-m-d H:i:s', time()-(60*60*24*3) ))->pluck('action_id')->toArray();
                                $orders = Order::whereIn('id', $orderIds)->get();
                                break;
                        case 'available':
                                $orderIds = Transaction::where('id', '>', 103)->where('shop_id', $shop->id)->where('action', 'order')->where('amount', '>', 0)->where('created_at', '>=', date('Y-m-d H:i:s', time()-(60*60*24*3) ))->pluck('action_id')->toArray();

                                $toDate = !empty($request->toDate) ? \Carbon\Carbon::parse($request->toDate) : \Carbon\Carbon::now();

                                if(empty($orderIds)) {
                                        $orderIds[] = 0;
                                }
                                $lastOutputTransaction = Transaction::where('shop_id', $shop->id)->where('action', 'out')->where('created_at', '<', $toDate->toDateTimeString())->orderBy('created_at', 'DESC')->first();
                                $dateFrom = !empty($lastOutputTransaction) ? \Carbon\Carbon::parse($lastOutputTransaction->created_at) : \Carbon\Carbon::parse('2010-10-10 00:00:00');
                                $orders = Order::where('shop_id', $shop->id)->where('status', 'completed')->whereNotIn('id', $orderIds)->where('created_at', '>', $dateFrom->format('Y-m-d H:i:s'))->get();
                                break;
                        default:
                                break;
                }

                return view('admin.invoices.orders',[
                        'orders' => $orders
                ]);

                echo $request->shop_id; exit();
                $shop = Shop::findOrFail($request->shop_id);
                $type = $request->type;

                echo $type; exit();

                $toDate = !empty($request->toDate) ? \Carbon\Carbon::parse($request->toDate) : \Carbon\Carbon::now();

                $lastOutputTransaction = Transaction::where('shop_id', $shop->id)->where('created_at', '<', $toDate->toDateTimeString())->orderBy('created_at', 'DESC')->first();
                dd($lastOutputTransaction);
        }
}

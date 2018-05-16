<?php

namespace App\Http\Controllers;

use App\Model\Shop;
use Illuminate\Http\Request;
use App\Model\Invoice;

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

        public function index(Request $request) {

                if(!$this->user->admin) {
                        return redirect()->route('admin.shop.profile');
                }

                $dateFrom = !empty($request->dateFrom) ? $request->dateFrom : '2018-01-01';
                $dateTo = !empty($request->dateTo) ? $request->dateTo : '2118-01-01';

                $perPage = 20;

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
}

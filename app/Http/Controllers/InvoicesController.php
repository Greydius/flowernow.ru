<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Invoice;

class InvoicesController extends Controller
{
    //
        public function index() {

                if(!$this->user->admin) {
                        return redirect()->route('admin.shop.profile');
                }

                $invoices = Invoice::orderBy('id', 'desc')->get();

                return view('admin.invoices.index',[
                        'invoices' => $invoices
                ]);
        }
}

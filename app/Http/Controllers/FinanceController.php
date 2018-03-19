<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Invoice;
use Illuminate\Support\Facades\Mail;

class FinanceController extends Controller
{
    //
        public function index() {
                $outputAvailable = $this->user->getShop()->availableOutBalance();
                $invoices = Invoice::where('shop_id', $this->user->getShop()->id)->orderBy('id', 'desc')->get();

                return view('admin.finance.index',[
                        'outputAvailable' => $outputAvailable,
                        'invoices' => $invoices
                ]);
        }
        
        public function request(Request $request) {
                $response = [];
                $response['statusCode'] = 200;

                $outputAvailable = $this->user->getShop()->availableOutBalance();

                $amount = !empty($request->amount) ? (int)$request->amount : null;

                if(empty($amount) || $amount < 0 || $amount > $outputAvailable) {
                        $response['statusCode'] = 400;
                        $response['message'] = 'Неправильная сумма';
                } else {

                        \DB::beginTransaction();

                        try {

                                $invoice = new Invoice();
                                $invoice->shop_id = $this->user->getShop()->id;
                                $invoice->amount = $amount;
                                
                                if($invoice->save() && $invoice->createTransaction()) {
                                        \DB::commit();
                                        \Session::flash('layoutWarning', ['type' => 'success', 'text' => 'Запрос на вывод средств успешно создан']);
                                        try {
                                                
                                                Mail::send('email.adminNewInvoice', ['shop' => $this->user->getShop(), ], function ($message) {
                                                        $message->to('service@floristum.ru')
                                                                ->subject('Создан новый запрос на вывод средств');
                                                });

                                        } catch (\Exception $e) {

                                        } catch(\Throwable $e) {
                                            // This should work as well
                                        }
                                }
                        } catch (\Exception $e) {

                                $response['statusCode'] = 400;
                                $response['message'] = $e->getMessage();
                                \DB::rollBack();
                        }
                }
                
                return response()->json($response, $response['statusCode']);
        }
}

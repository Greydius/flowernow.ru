<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Model\Order;
use App\Model\Product;
use App\Model\CashVoucher;

class GenerateCashVoucher extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'voucher:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //

            $orders = Order::with(['orderLists.product'])->where('id', '>', '37390')->where('payment', Order::$PAYMENT_CARD)->where('payed', 1)->doesntHave('cashVouchers')->get();
            //$orders = Order::with(['orderLists.product'])->where('id', '=', '37394')->get();

            $client = new \Platron\Atol\clients\PostClient();

            $tokenService = new \Platron\Atol\services\GetTokenRequest('floristum-ru', '6iabjyA0K');
            $tokenResponse = new \Platron\Atol\services\GetTokenResponse($client->sendRequest($tokenService));

            foreach($orders as $order) {
                    $createDocumentService = (new \Platron\Atol\services\CreateDocumentRequest($tokenResponse->token));
                    $i = 0;
                    foreach($order->orderLists as $orderList) {
                            $receiptPosition = new \Platron\Atol\data_objects\ReceiptPosition($orderList->product->name.($orderList->single ? ' ('.$orderList->qty.' шт.)' : ''), $orderList->client_price + ($i == 0 ? ($orderList->single ? $order->delivery_price : 0) + ($order->delivery_out_distance ? $order->delivery_out_distance*$order->delivery_out_price : 0) : 0), 1, \Platron\Atol\data_objects\ReceiptPosition::TAX_NONE);
                            $createDocumentService->addReceiptPosition($receiptPosition);
                            $i++;
                    }
                    
                    if(!empty($order->email)) {
                            $createDocumentService->addCustomerEmail($order->email);
                    }

                    if(!empty($order->phone)) {
                            $createDocumentService->addCustomerPhone($order->phone);
                    }

                    $createDocumentService->addGroupCode('floristum-ru_8783')
                            ->addInn('7807189999')
                            ->addCompanyEmail('info@floristum.ru')
                            ->addMerchantAddress('https://floristum.ru/')
                            ->addOperationType(\Platron\Atol\services\CreateDocumentRequest::OPERATION_TYPE_SELL)
                            ->addPaymentType(\Platron\Atol\services\CreateDocumentRequest::PAYMENT_TYPE_ELECTRON)
                            ->addSno(\Platron\Atol\services\CreateDocumentRequest::SNO_USN_INCOME_OUTCOME)
                            ->addExternalId($order->id);

                    $createDocumentResponse = new \Platron\Atol\services\CreateDocumentResponse($client->sendRequest($createDocumentService));
                    //print_r($createDocumentResponse);


                    $cashVoucher = new CashVoucher();
                    $cashVoucher->order_id = $order->id;
                    $cashVoucher->uuid = $createDocumentResponse->uuid;
                    $cashVoucher->save();
            }
    }
}

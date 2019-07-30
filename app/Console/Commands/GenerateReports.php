<?php

namespace App\Console\Commands;

use App\Model\Order;
use App\Model\Shop;
use App\Model\ShopReport;
use App\Helpers\Sms;
use Illuminate\Console\Command;
use Dompdf\Dompdf;
use Dompdf\Options;

class GenerateReports extends Command
{
        /**
         * The name and signature of the console command.
         *
         * @var string
         */
        protected $signature = 'report:gen';

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
                //$reportDate = '2019-05-13';

                //$date = \Carbon\Carbon::parse($reportDate);
                $date = new \Carbon\Carbon('first day of last month');

                $shops = Shop::with(['users'])->whereExists(function ($query) use ($date) {
                        $query->select(\DB::raw(1))
                                ->from('orders')
                                ->whereRaw('orders.shop_id = shops.id')
                                ->where('payed_at', '>=', $date->startOfMonth()->format('Y-m-d 00:00:00'))->where('payed_at', '<=', $date->endOfMonth()->format('Y-m-d 23:59:59'));
                })->where('id', '!=', '1')->get();

                //dd(count($shops));

                foreach($shops as $shop) {


                        $dompdf = new Dompdf();
                        $dompdf->set_option('isRemoteEnabled', true);
                        $dompdf->set_option('isHtml5ParserEnabled', true);

                        //$date = date('d').' '.\App\Helpers\AppHelper::ruMonth(date('m')).' '.date('Y').' г.';
                        //$date = \Carbon::now()->subMonth();

                        $firstOrder = Order::where('shop_id', $shop->id)->where('payed', 1)->where('payment', '!=', 'cash')->first();

                        $orderReq = Order::where('shop_id', $shop->id)
                                ->where(function ($query) use ($date) {
                                        $query->where(function ($query) use ($date) {
                                                $query->where('payment', '=', 'cash')
                                                        ->where('payed', '=', '1')
                                                        ->where('confirmed', '=', '1')
                                                        ->where('created_at', '>=', $date->startOfMonth()->format('Y-m-d 00:00:00'))->where('created_at', '<=', $date->endOfMonth()->format('Y-m-d 23:59:59'));
                                        })->orWhere(function ($query) use ($date) {
                                                $query->where('payed_at', '>=', $date->startOfMonth()->format('Y-m-d 00:00:00'))->where('payed_at', '<=', $date->endOfMonth()->format('Y-m-d 23:59:59'));
                                        });
                                });

                        $viewOptions = [
                                'date' => clone $date,
                                'firstOrder' => $firstOrder,
                                'orders' => $orderReq->get(),
                                'shop' => Shop::find($shop->id),
                                'type' => 'pdf'
                                //'header' => 'Счет на оплату № '.$order->id.' от '.$date,
                                //'order' => $order
                        ];

                        $view = view('reports.report', $viewOptions)->render();

                        //echo $view; exit();

                        $dompdf->loadHtml($view, 'UTF-8');

                        // (Optional) Setup the paper size and orientation
                        //$dompdf->setPaper('A4', 'landscape');

                        // Render the HTML as PDF
                        $dompdf->render();

                        // Output the generated PDF to Browser
                        //$dompdf->stream('report_'.$shop->id.'_'.$date->format('Y-m').'.pdf');

                        $orderWarnings = $orderReq->whereNotNull('finance_comment')->count();

                        $report = new ShopReport();

                        $output = $dompdf->output();

                        $report->shop_id = $shop->id;
                        $report->report_date = $date->startOfMonth()->format('Y-m-d');
                        $report->ext = 'pdf';
                        $report->file = base64_encode($output);
                        $report->warning = $orderWarnings;
                        $report->save();

                        //$date2 = \Carbon\Carbon::parse($reportDate);
                        $date2 = new \Carbon\Carbon('first day of last month');

                        $viewOptions['type'] = 'docx';
                        $viewOptions['date'] = clone $date2;

                        $view = view('reports.report', $viewOptions)->render();
                        $report = new ShopReport();

                        $report->shop_id = $shop->id;
                        $report->report_date = $date2->startOfMonth()->format('Y-m-d');
                        $report->ext = 'docx';
                        $report->file = base64_encode($view);
                        $report->warning = $orderWarnings;
                        $report->save();
                }


        }
}
<?php

namespace App\Http\Controllers;

use App\Model\Shop;
use App\Model\ShopReport;
use Illuminate\Http\Request;

class ReportsController extends Controller {
        
        function all() {

                $perPage = 20;

                $reports = ShopReport::with(['shop'])->select(['id', 'report_date', 'ext', 'shop_id', 'warning'])->paginate($perPage);

                return view('admin.reports.list', [
                        'reports' => $reports
                ]);

        }
}
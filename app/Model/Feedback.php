<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Feedback extends Model
{
    //

        // relation for product
        function product() {
                return $this->belongsTo('App\Model\Product');
        }

        // relation for shop
        function shop() {
                return $this->belongsTo('App\Model\Shop');
        }

        // relation for order
        function order() {
                return $this->belongsTo('App\Model\Order');
        }

        public static function getTodayFeedback($city_id) {
                $date = new Carbon();

                $feedback =  Feedback::whereHas('shop', function($query) use ($city_id) {
                        $query->where('city_id', $city_id)->available();
                })->where('approved', 1)->whereBetween('feedback_date_tmp', [$date->format('Y-m-d 00:00:00'), $date->format('Y-m-d 23:59:59')])->take(1)->get();


                if(count($feedback)) {
                        return $feedback;
                } else {
                        $feedback =  Feedback::whereHas('shop', function($query) use ($city_id) {
                                $query->where('city_id', $city_id)->available();
                        })->where('approved', 1)->orderBy('feedback_date_tmp', 'asc')->take(1)->get();

                        if(!empty($feedback)) {
                                $feedback[0]->feedback_date_tmp = $date->format('Y-m-d H:i:s');
                                $feedback[0]->save();
                                return $feedback;
                        }
                }

                return null;
        }
}

<?php

namespace App\Model;

use App\MainModel;
use App\Model\Feedback;

class FeedbackCity extends MainModel
{
        //

        public static function getCityTopFeedbackId($city_id) {
                $feedbackId = null;
                $feedbackCity = self::where('city_id', $city_id)->first();

                if(empty($feedbackCity)) {
                        $feedback = Feedback::whereHas('shop', function($query) use ($city_id) {
                                $query->where('city_id', $city_id)->available();
                        })->where('approved', 1)->orderBy(\DB::raw('RAND()'))->first();

                        if(count($feedback)) {
                                $_feedbackCity = new self();
                                $_feedbackCity->city_id = $city_id;
                                $_feedbackCity->feedback_id = $feedback->id;
                                $_feedbackCity->post_at = date('Y-m-d');
                                $_feedbackCity->save();
                                $feedbackId = $feedback->id;
                        }
                } else {
                        if($feedbackCity->post_at != date('Y-m-d')) {
                                $feedback = Feedback::whereHas('shop', function($query) use ($city_id) {
                                        $query->where('city_id', $city_id)->available();
                                })->where('approved', 1)->orderBy(\DB::raw('RAND()'))->first();

                                if(count($feedback)) {
                                        $feedbackCity->feedback_id = $feedback->id;
                                        $feedbackCity->post_at = date('Y-m-d');
                                        $feedbackCity->save();
                                }
                        }

                        $feedbackId = $feedbackCity->feedback_id;
                }

                return $feedbackId;
        }
}

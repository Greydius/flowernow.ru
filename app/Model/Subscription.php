<?php

namespace App\Model;

use App\MainModel;
use App\Model\SubscriptionList;

class Subscription extends MainModel
{
    //
        public function run() {
                $parameters = json_decode($this->parameters);

                $sql = 'SELECT DISTINCT phone_clean FROM f_order WHERE phone_clean IS NOT NULL AND phone_clean != "" AND city IN ('.implode(',', $parameters->cities).')';

                $subscriptionList = new SubscriptionList();
                $subscriptionList->subscription_id = $this->id;
                $subscriptionList->phone = '79119245792';
                $subscriptionList->message = $this->message;
                $subscriptionList->save();

                $phones = \DB::select($sql);

                foreach ($phones as $phone) {
                        $subscriptionList = new SubscriptionList();
                        $subscriptionList->subscription_id = $this->id;
                        $subscriptionList->phone = $phone->phone_clean;
                        $subscriptionList->message = $this->message;
                        //$subscriptionList->send = 1;
                        $subscriptionList->save();
                }
        }

        // relation for Subscription List
        function subscriptionList() {
                return $this->hasMany('App\Model\SubscriptionList');
        }
}

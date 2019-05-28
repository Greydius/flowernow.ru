<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Model\SubscriptionList;
use App\Model\Subscription;
use App\Model\PromoCode;
use App\Helpers\Sms;

class CheckSubscription extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscription:check';

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
            $subscriptions = Subscription::where('active', 1)->where('start_time', date('H:i'))->get();

            //$subscriptions = Subscription::where('id',10)->get();

            foreach ($subscriptions as $subscription) {
                    $parameters = json_decode($subscription->parameters);

                    $day = date('d', strtotime("+1 day"));
                    $month = date('m', strtotime("+1 day"));

                    /*
                    $sql = 'SELECT DISTINCT phone_clean FROM f_order WHERE phone_clean IS NOT NULL AND phone_clean != "" 
                            AND city IN (' . implode(',', $parameters->cities) . ')
                            AND (
                                (DAY(day) = '.(int)$day.' AND MONTH(day) = '.(int)$month.' AND DAY(FROM_UNIXTIME(dt)) = '.(int)$day.' AND MONTH(FROM_UNIXTIME(dt)) = '.(int)$month.') 
                                OR
                                (DAY(day) = '.(int)date('d').' AND MONTH(day) = '.(int)date('m').' AND DAY(FROM_UNIXTIME(dt)) != '.(int)date('d').' )
                            )
                            ';
                    */

                    $sql = "SELECT '79803888394' AS phone_clean";

                    $message = $subscription->message;

                    if (strpos($message, '[promo]') !== false) {
                            $promo_code = PromoCode::getNewCode();

                            $promoCode = new PromoCode();
                            $promoCode->code = $promo_code;
                            $promoCode->code_type = 'percent';
                            $promoCode->value = 7;

                            if ($promoCode->save()) {
                                    $message = str_replace('[promo]', $promo_code, $message);
                            }
                    }

                    $subscriptionList = new SubscriptionList();
                    $subscriptionList->subscription_id = $subscription->id;
                    $subscriptionList->phone = '79119245792';
                    //$subscriptionList->phone = '79803888394';
                    $subscriptionList->message = $message;
                    $subscriptionList->save();

                    $phones = \DB::select($sql);


                    foreach ($phones as $phone) {
                            $message = $subscription->message;
                            if(strpos($message, '[promo]') !== false) {
                                    $promo_code = PromoCode::getNewCode();

                                    $promoCode = new PromoCode();
                                    $promoCode->code = $promo_code;
                                    $promoCode->code_type = 'percent';
                                    $promoCode->value = 15;

                                    if($promoCode->save()) {
                                             $message = str_replace('[promo]', $promo_code, $message);
                                    }
                            }
                            $subscriptionList = new SubscriptionList();
                            $subscriptionList->subscription_id = $subscription->id;
                            $subscriptionList->phone = $phone->phone_clean;
                            $subscriptionList->message = $message;
                            //$subscriptionList->send = 1;
                            $subscriptionList->save();
                    }

                    exit();
            }
    }
}

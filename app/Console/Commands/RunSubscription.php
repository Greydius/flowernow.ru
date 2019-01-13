<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Model\SubscriptionList;
use App\Helpers\Sms;

class RunSubscription extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscription:run';

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
            $subscriptionLists = SubscriptionList::where('send', 0)->limit(10)->get();
            foreach ($subscriptionLists as $item) {
                    $item->send = 1;
                    if($item->save()) {
                            Sms::instance()->send($item->phone, $item->message);
                    }
            }
    }
}

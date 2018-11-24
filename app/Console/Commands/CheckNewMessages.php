<?php

namespace App\Console\Commands;

use App\Model\Message;
use App\Helpers\Sms;
use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Command;

class CheckNewMessages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'message:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check not sent messages and send it';

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
            $messages = Message::whereNull('sent_at')->get();

            if(!empty($messages)) {
                    foreach ($messages as $message) {
                            $messageDetails = json_decode($message->msg);

                            if($message->message_type == 'email') {

                                    try {
                                            Mail::send([], [], function ($m) use ($message, $messageDetails) {

                                                    $m->to($message->send_to)
                                                            ->subject($messageDetails->subject)
                                                            ->setBody($messageDetails->text, 'text/html');
                                            });
                                            $message->sent_at = \Carbon::now()->format('Y-m-d H:i:s');
                                            $message->save();
                                    } catch(\Exception $e){
                                            echo $e->getMessage();
                                    }

                            } elseif($message->message_type == 'sms') {
                                    try {
                                            Sms::instance()->send($message->send_to, $messageDetails->text);
                                            $message->sent_at = \Carbon::now()->format('Y-m-d H:i:s');
                                            $message->save();
                                    } catch(\Exception $e){

                                    }
                            }
                    }
            }
    }
}

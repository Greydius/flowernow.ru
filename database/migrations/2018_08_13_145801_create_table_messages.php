<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMessages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
        public function up()
        {
                Schema::create('messages', function (Blueprint $table) {
                        $table->increments('id');
                        $table->text('msg');
                        $table->string('send_to', 100);
                        $table->enum('message_type', ['email', 'sms']);
                        $table->dateTime('sent_at')->nullable();
                        $table->timestamps();

                        $table->index('sent_at');
                });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
                Schema::dropIfExists('messages');
        }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldSmsCodeConfirmed extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
                $table->string('sms_code', 6)->nullable();
                $table->dateTime('sms_send_at')->nullable();
                $table->boolean('confirmed')->default(1);
                $table->index('confirmed');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
                $table->dropColumn('sms_code');
                $table->dropColumn('sms_send_at');
                $table->dropColumn('confirmed');
        });
    }
}

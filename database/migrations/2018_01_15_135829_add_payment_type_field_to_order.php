<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPaymentTypeFieldToOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
            Schema::table('orders', function(Blueprint $table) {

                    $table->enum('payment', ['card', 'rs', 'cash'])->default('card');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
            Schema::table('orders', function (Blueprint $table) {
                    $table->dropColumn('payment');
            });
    }
}

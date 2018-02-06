<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPayedStatusFieldsToOrder extends Migration
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

                    $table->enum('status', ['new', 'accepted', 'completed'])->default('new');

                    $table->boolean('payed')->default(0);
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
                    $table->dropColumn('status');
                    $table->dropColumn('payed');
            });
    }
}

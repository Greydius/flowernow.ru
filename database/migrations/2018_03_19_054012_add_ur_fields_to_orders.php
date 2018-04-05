<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUrFieldsToOrders extends Migration
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
                $table->string('ur_name')->nullable();
                $table->string('ur_inn')->nullable();
                $table->string('ur_kpp')->nullable();
                $table->string('ur_address')->nullable();
                $table->string('ur_bank')->nullable();
                $table->string('ur_email')->nullable();

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
                $table->dropColumn('ur_name');
                $table->dropColumn('ur_inn');
                $table->dropColumn('ur_kpp');
                $table->dropColumn('ur_address');
                $table->dropColumn('ur_bank');
                $table->dropColumn('ur_email');
        });
    }
}

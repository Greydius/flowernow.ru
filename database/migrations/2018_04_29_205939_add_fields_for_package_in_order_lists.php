<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsForPackageInOrderLists extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_lists', function (Blueprint $table) {
            //
                $table->integer('package_id')->nullable();
                $table->integer('package_price')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_lists', function (Blueprint $table) {
            //
                $table->dropColumn('package_id');
                $table->dropColumn('package_price');
        });
    }
}

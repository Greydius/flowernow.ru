<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsForShop extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
            Schema::table('shops', function(Blueprint $table) {

                    $table->integer('city_id');

                    $table->index(['city_id']);
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
            Schema::table('products', function (Blueprint $table) {
                    $table->dropColumn('city_id');
                    $table->dropIndex(['city_id']);
            });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsForProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
            Schema::table('products', function(Blueprint $table) {

                    $table->integer('color_id')->nullable();
                    $table->integer('product_type_id')->nullable();

                    $table->index(['color_id']);
                    $table->index(['product_type_id']);
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
                    $table->dropColumn('color_id');
                    $table->dropColumn('product_type_id');

                    $table->dropIndex(['color_id']);
                    $table->dropIndex(['product_type_id']);
            });
    }
}

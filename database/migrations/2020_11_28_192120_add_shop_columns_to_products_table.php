<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddShopColumnsToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->integer('shop_city_id');
            $table->index(['shop_city_id']);
            $table->decimal('shop_delivery_price', 10, 2)->nullable();
            $table->integer('shop_delivery_time')->nullable();
            $table->boolean('shop_delivery_out')->default(1);
            $table->integer('shop_delivery_out_max')->nullable();
            $table->decimal('shop_delivery_out_price', 10, 2)->nullable();
            $table->boolean('shop_active')->default(1)->index();
            $table->boolean('shop_delivery_free')->default(0);
            $table->integer('shop_copy_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('shop_city_id');
            $table->dropColumn('shop_delivery_price');
            $table->dropColumn('shop_delivery_time');
            $table->dropColumn('shop_delivery_out');
            $table->dropColumn('shop_delivery_out_max');
            $table->dropColumn('shop_delivery_out_price');
            $table->dropColumn('shop_active');
            $table->dropColumn('shop_delivery_free');
            $table->dropColumn('shop_copy_id');
        });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopWorkTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_work_times', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shop_id')->index();
            $table->integer('day');
            $table->boolean('is_work')->default(0);
            $table->boolean('round_clock')->default(0);
            $table->integer('work_from');
            $table->integer('work_to');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shop_work_times');
    }
}

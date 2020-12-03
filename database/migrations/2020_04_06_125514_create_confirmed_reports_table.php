<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfirmedReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('confirmed_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shop_id')->references('id')->on('shops');
            $table->string('date', 10);
            $table->string('file', 255)->nullable();
            $table->boolean('confirmed')->default(0);
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
        Schema::dropIfExists('confirmed_reports');
    }
}

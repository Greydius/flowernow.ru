<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shop_id');
            $table->integer('order_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->string('name');
            $table->text('feedback');
            $table->integer('rating');
            $table->text('answer')->nullable();
            $table->dateTime('feedback_date');
            $table->timestamps();

            $table->index('shop_id');
            $table->index('order_id');
            $table->index('product_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feedback');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductCompositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_compositions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id');
            $table->integer('flower_id');
            $table->integer('qty')->default(0);
            $table->timestamps();

            $table->index(['product_id', 'flower_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_compositions');
    }
}

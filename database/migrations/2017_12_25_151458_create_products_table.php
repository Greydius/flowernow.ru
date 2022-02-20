<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shop_id');
            $table->string('name');
            $table->string('slug');
            $table->integer('price')->nullable();
            $table->text('description')->nullable();
            $table->string('photo');
            $table->integer('make_time')->nullable();
            $table->integer('width')->nullable();
            $table->integer('height')->nullable();
            $table->boolean('dop')->default(0);
            $table->boolean('approved')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['shop_id']);
            $table->index(['dop']);
            $table->index(['approved']);
            $table->index(['slug']);
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}

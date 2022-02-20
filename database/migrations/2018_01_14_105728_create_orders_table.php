<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shop_id');
            $table->string('recipient_name')->nullable();
            $table->string('recipient_phone')->nullable();
            $table->string('recipient_address')->nullable();
            $table->string('recipient_flat')->nullable();
            $table->string('recipient_info')->nullable();
            $table->boolean('recipient_self')->default(0);

            $table->date('receiving_date');
            $table->string('receiving_time');

            $table->boolean('anonymous')->default(0);

            $table->string('name')->nullable();
            $table->string('phone');
            $table->string('email')->nullable();

            $table->text('text')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}

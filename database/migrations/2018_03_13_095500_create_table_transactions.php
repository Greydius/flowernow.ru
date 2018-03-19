<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
            Schema::create('transactions', function (Blueprint $table) {
                    $table->increments('id');
                    $table->integer('shop_id')->index();
                    $table->enum('action', ['order', 'out']);
                    $table->integer('action_id')->index();
                    $table->decimal('amount', 10, 2);
                    $table->decimal('subtract', 10, 2);
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
        //
            Schema::dropIfExists('transactions');
    }
}

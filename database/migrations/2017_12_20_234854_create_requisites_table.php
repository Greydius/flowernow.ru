<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequisitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisites', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shop_id');
            $table->string('name');
            $table->string('rs');
            $table->string('bank');
            $table->string('bik');
            $table->string('ks');
            $table->string('inn');
            $table->string('kpp');
            $table->string('ogrn');
            $table->string('address');
            $table->string('director');
            $table->string('ustav');
            $table->timestamps();

            $table->index('shop_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requisites');
    }
}

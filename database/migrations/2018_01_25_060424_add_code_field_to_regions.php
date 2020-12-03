<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCodeFieldToRegions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
            Schema::table('regions', function(Blueprint $table) {

                    $table->integer('code')->nullable();
                    $table->string('codes')->nullable();
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
            Schema::table('regions', function (Blueprint $table) {
                    $table->dropColumn('code');
                    $table->dropColumn('codes');
            });
    }
}

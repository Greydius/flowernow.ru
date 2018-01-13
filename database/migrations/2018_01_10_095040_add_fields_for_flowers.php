<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsForFlowers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
            Schema::table('flowers', function(Blueprint $table) {

                    $table->integer('popularity')->default(0);

                    $table->index(['popularity']);
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
            Schema::table('flowers', function (Blueprint $table) {
                    $table->dropColumn('popularity');

                    $table->dropIndex(['popularity']);
            });
    }
}

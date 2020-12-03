<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsForProductTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
            Schema::table('product_types', function(Blueprint $table) {

                    $table->boolean('show_on_main')->default(0);
                    $table->string('icon');

                    $table->index(['show_on_main']);
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
            Schema::table('product_types', function (Blueprint $table) {
                    $table->dropColumn('show_on_main');
                    $table->dropColumn('icon');

                    $table->dropIndex(['show_on_main']);
            });
    }
}

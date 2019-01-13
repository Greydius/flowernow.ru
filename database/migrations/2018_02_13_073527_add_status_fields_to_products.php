<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusFieldsToProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            //
                $table->smallInteger('status')->default(0)->index()->comment('0 - не заполнены обязательные поля; 1 - опубликовано; 2 - на проверке у администратора; 3- отклонено модератором');
                $table->text('status_comment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //
                $table->dropColumn('status');
                $table->dropColumn('status_comment');
        });
    }
}

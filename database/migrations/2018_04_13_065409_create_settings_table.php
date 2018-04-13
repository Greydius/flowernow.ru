<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
                $table->increments('id');
                $table->string('key');
                $table->text('value')->nullable();
                $table->string('name');
                $table->timestamps();

                $table->unique('key');
        });

            DB::table('settings')->insert(
                    [
                            'name' => 'Комиссия на букеты %',
                            'key' => 'product_commission',
                            'value' => '20'
                    ]
            );

            DB::table('settings')->insert(
                    [
                            'name' => 'Комиссия на поштучные %',
                            'key' => 'single_product_commission',
                            'value' => '10'
                    ]
            );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}

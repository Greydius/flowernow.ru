<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewFieldsToShop extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shops', function (Blueprint $table) {
            //
                $table->string('contact_phone')->nullable();
                $table->string('site')->nullable();
                $table->string('vk')->nullable();
                $table->string('ok')->nullable();
                $table->string('fb')->nullable();
                $table->string('instagram')->nullable();
                $table->string('youtube')->nullable();
                $table->decimal('delivery_price', 10, 2)->nullable();
                $table->integer('delivery_time')->nullable();
                $table->boolean('delivery_out')->default(1);
                $table->integer('delivery_out_max')->nullable();
                $table->decimal('delivery_out_price', 10, 2)->nullable();
                $table->string('org_name')->nullable();
                $table->string('rs')->nullable();
                $table->string('bank')->nullable();
                $table->string('bik')->nullable();
                $table->string('ks')->nullable();
                $table->string('inn')->nullable();
                $table->string('kpp')->nullable();
                $table->string('ogrn')->nullable();
                $table->string('org_address')->nullable();
                $table->string('director')->nullable();
                $table->string('osnovanie')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shops', function (Blueprint $table) {
            //
                $table->dropColumn('contact_phone');
                $table->dropColumn('site');
                $table->dropColumn('vk');
                $table->dropColumn('ok');
                $table->dropColumn('fb');
                $table->dropColumn('instagram');
                $table->dropColumn('youtube');
                $table->dropColumn('delivery_price');
                $table->dropColumn('delivery_time');
                $table->dropColumn('delivery_out');
                $table->dropColumn('delivery_out_max');
                $table->dropColumn('delivery_out_price');
                $table->dropColumn('org_name');
                $table->dropColumn('rs');
                $table->dropColumn('bank');
                $table->dropColumn('bik');
                $table->dropColumn('ks');
                $table->dropColumn('inn');
                $table->dropColumn('kpp');
                $table->dropColumn('ogrn');
                $table->dropColumn('org_address');
                $table->dropColumn('director');
                $table->dropColumn('osnovanie');
        });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTriggerToProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
            DB::unprepared('
                CREATE TRIGGER `add_product_photo` AFTER INSERT ON `products` FOR EACH ROW INSERT INTO product_photos ( product_id, photo, created_at, updated_at) VALUES ( NEW.id, NEW.photo, NOW(), NOW());
                ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
            DB::unprepared('DROP TRIGGER `add_product_photo`');
    }
}

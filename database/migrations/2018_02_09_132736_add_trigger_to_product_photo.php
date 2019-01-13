<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTriggerToProductPhoto extends Migration
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
                CREATE TRIGGER `update_main_photo` AFTER UPDATE ON `product_photos` FOR EACH ROW IF(NEW.priority = 0) THEN UPDATE products SET photo = NEW.photo WHERE id = NEW.product_id; END IF
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
            DB::unprepared('DROP TRIGGER `update_main_photo`');
    }
}

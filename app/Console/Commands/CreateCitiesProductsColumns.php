<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesProductsColumns extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cities:tables';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Products tables for orders';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        for($i = 1; $i <= 37; $i++) {
            Schema::create('products_' . $i, function(Blueprint $table)
            {
                $table->increments('id');
                $table->integer('shop_id')->index('shop_id');
                $table->string('name', 191)->index('name');
                $table->string('slug', 191)->index();
                $table->integer('price')->nullable();
                $table->text('description', 65535)->nullable();
                $table->string('photo', 191);
                $table->integer('make_time')->nullable();
                $table->integer('width')->nullable();
                $table->integer('height')->nullable();
                $table->boolean('dop')->default(0);
                $table->boolean('approved')->default(0)->index();
                $table->timestamps();
                $table->softDeletes();
                $table->integer('color_id')->nullable()->index();
                $table->integer('product_type_id')->nullable();
                $table->smallInteger('status')->default(0)->comment('0 - не заполнены обязательные поля; 1 - опубликовано; 2 - на проверке у администратора; 3- отклонено модератором');
                $table->text('status_comment', 65535)->nullable();
                $table->boolean('pause')->default(0);
                $table->string('special_offer_id', 191)->nullable()->index();
                $table->integer('sort')->nullable()->index();
                $table->integer('single')->nullable();
                $table->dateTime('status_comment_at')->nullable();
                $table->boolean('star')->default(0)->index('star');
                $table->integer('block_id')->nullable()->index('block_id');
                $table->integer('copy_id')->nullable();
                $table->index(['price','dop','status','pause','single','product_type_id','deleted_at','shop_id'], 'price_2');
                $table->unique(['shop_id','slug'], 'shop_id_slug');
            }); 
            
            $this->info('products_' . $i);
        }
        
    }
}

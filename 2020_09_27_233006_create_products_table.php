<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function(Blueprint $table)
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
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('products');
	}

}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePromotions extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('promotions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->nullable();
			$table->string('slug')->nullable();
			$table->text('description')->nullable();
			$table->text('content')->nullable();
			$table->string('img_avatar')->nullable();
			$table->string('img_icon')->nullable();
			$table->boolean('status')->default('1');
			$table->integer('order')->nullable();
			$table->string('meta_keywords')->nullable();
			$table->text('meta_description')->nullable();
			$table->string('meta_share')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('promotions');
	}

}

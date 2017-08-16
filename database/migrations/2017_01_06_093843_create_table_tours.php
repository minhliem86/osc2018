<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTours extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tours', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title')->nullable();
			$table->string('slug')->nullable();
			$table->string('tour_code')->nullable();
			$table->text('description')->nullable();
			$table->text('content')->nullable();
			$table->string('img_avatar')->nullable();
			$table->string('partner')->nullable();
			$table->string('stay')->nullable();
			$table->string('week')->nullable();
			$table->string('start')->nullable();
			$table->string('end')->nullable();
			$table->string('price')->nullable();
			$table->string('age')->nullable();
			$table->string('meta_keywords')->nullable();
			$table->text('meta_description')->nullable();
			$table->string('meta_share')->nullable();
			$table->boolean('status')->default('1');
			$table->integer('order');
			$table->integer('country_id')->unsigned();
			$table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
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
		Schema::drop('tours');
	}

}

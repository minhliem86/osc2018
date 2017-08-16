<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTourLocation extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tour_location', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('tour_id')->unsigned();
			$table->integer('location_id')->unsigned();
			$table->foreign('tour_id')->references('id')->on('tours')->onDelete('cascade');
			$table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
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
		Schema::drop('tour_location');
	}

}

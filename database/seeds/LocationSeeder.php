<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Faker\Factory as Faker;


class LocationSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = Faker::create();
		for($i = 1; $i<=5 ; $i++){
			DB::table('locations')->insert([
				'title' => $faker->city,
				'status' => 1,
				'order' => $i,
			]);
		}
	}

}

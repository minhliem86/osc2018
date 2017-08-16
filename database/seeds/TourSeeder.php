<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Faker\Factory as Faker;


class TourSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = Faker::create();
		for($i = 1; $i<=5 ; $i++){
			DB::table('tours')->insert([
				'title' => $faker->sentence,
				'description' => $faker->paragraph,
				'content' => $faker->text,
				'img_avatar' => $faker->imageUrl('480','480','cats'),
				'partner' => $faker->company,
				'stay' => $faker->streetAddress,
				'week' => 3,
				'start' => $faker->date('d-m-Y'),
				'end' => $faker->date('d-m-Y'),
				'price' => $faker->numberBetween,
				'country_id' => $i,
				'status' => 1,
				'order' => $i,
			]);
		}
	}

}

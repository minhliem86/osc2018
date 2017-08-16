<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Faker\Factory as Faker;


class PromotionSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = Faker::create();
		for($i = 1; $i<=5 ; $i++){
			DB::table('promotions')->insert([
				'name' => $faker->sentence,
				'description' => $faker->paragraph,
				'content' => $faker->text,
				'img_avatar' => $faker->imageUrl('480','480','cats'),
				'status' => 1,
				'order' => $i,
			]);
		}
	}

}

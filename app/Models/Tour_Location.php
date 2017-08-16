<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tour_Location extends Model {
	public $table = "tour_location";

	protected $fillable = ['tour_id','location_id'];
}

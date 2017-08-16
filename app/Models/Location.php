<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model {

	public $table = 'locations';

	protected $fillable = ['id_city','id_center','title','slug','status','order'];

	public function tour(){
		return $this->belongsToMany('App\Models\Tour','tour_location','tour_id','location_id');
	}

}

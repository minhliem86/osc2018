<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model {

	public $table = 'schedules';

	protected $fillable = ['title','content','img_avatar','status','tour_id'];

	public function tour(){
		return $this->belongsTo('App\Models\Tour','tour_id');
	}

}

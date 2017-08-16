<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model {

	public $table = "countries";

	protected $fillable = ['name','slug','status','order','img_avatar','description','multi_countries','home_show','meta_keyword', 'meta_description', 'meta_share'];

	public function tour(){
		return $this->hasMany('App\Models\Tour','country_id');
	}

	public function images(){
		return $this->hasMany('App\Models\Image','country_id');
	}

	public function medias()
	{
		return $this->morphMany('App\Models\Media','mediable');
	}
}

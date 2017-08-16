<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model {

	public $table = 'promotions';

	protected $fillable =['name', 'slug','description','content','img_avatar','img_icon','status','order'];

}

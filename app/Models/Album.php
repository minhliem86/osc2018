<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Album extends Model{

  public $table = 'albums';

  protected $fillable =  [ 'title','slug', 'status', 'img_url', 'tour_id','order'];

  public function tours(){
    return $this->belongsTo('App\Models\Tour', 'tour_id');
  }

  public function photos(){
    return $this->hasMany('App\Models\Photo');
  }

  public function videos(){
    return $this->hasMany('App\Models\Video');
  }

}

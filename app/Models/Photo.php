<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model{
  public $table = 'photos';

  protected $fillable = ['title', 'img_url', 'status', 'thumbnail_url', 'order', 'filename', 'album_id'];

  public function albums(){
    return $this->belongsTo('App\Models\Album', 'album_id');
  }
}

<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model {

	public $table = 'medias';

    protected $fillable = ['type', 'img_url'];

    public function mediable()
    {
        return $this->morphTo();
    }

}

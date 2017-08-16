<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogCreateUser extends Model {

	public $table = 'log_create_users';

  protected $fillable = ['username', 'init_password', 'email', 'name'];

}

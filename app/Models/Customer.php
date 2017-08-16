<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Customer extends Model implements AuthenticatableContract, CanResetPasswordContract  {

	use Authenticatable, CanResetPassword;

	public $table = 'customers';

  protected $fillable = ['name','email','password','username','tour_id','super'];

	protected $hidden = ['password', 'remember_token'];

}

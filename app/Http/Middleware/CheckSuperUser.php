<?php namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckSuperUser {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	 protected $auth;

  	public function __construct(){
  		$this->auth = Auth::client();
  	}


	public function handle($request, Closure $next)
	{
		if(!$this->auth->check()){
			return redirect()->route('f.getLoginCustomer')->withErrors('error','Vui lòng Đăng nhập.');
			if(!$this->auth->super){
				$this->auth->logout();
				return redirect()->route('f.getLoginCustomer')->withErrors('error','Bạn không có quyền truy cập.');
			}
		}
		return $next($request);
	}

}

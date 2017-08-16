<?php namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckLoginMiddleware {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	protected $auth;

	public function __construct(){
		$this->auth = Auth::admin();
	}
	public function handle($request, Closure $next)
	{
		if($this->auth->check() && $this->auth->get()->can('login_dashboard')){
			return $next($request);
		}
		$this->auth->logout();
		return redirect()->route('admin.getlogin')->withInput()->withErrors('error','You do not have permission to access page.');
	}

}

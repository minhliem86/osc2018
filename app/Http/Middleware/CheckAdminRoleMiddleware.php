<?php namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckAdminRoleMiddleware {

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
		if($this->auth->check() && $this->auth->get()->hasRole('admin')){
			return $next($request);
		}
		return redirect()->back()->withErrors('errors', 'You do not have permission');
	}

}

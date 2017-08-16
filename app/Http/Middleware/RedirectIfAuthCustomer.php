<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\RedirectResponse;
use Auth;

class RedirectIfAuthCustomer {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	 /**
 	 * The Guard implementation.
 	 *
 	 * @var Guard
 	 */
 	protected $auth;

 	/**
 	 * Create a new filter instance.
 	 *
 	 * @param  Guard  $auth
 	 * @return void
 	 */
 	public function __construct()
 	{
 		// $this->auth = $auth;
 		$this->auth = Auth::client();
 	}

	 public function handle($request, Closure $next)
 	{
 		if ($this->auth->check())
 		{
			return redirect()->route('f.album');
 		// 	return new RedirectResponse(url('/'));
 		}

 		return $next($request);
 	}

}

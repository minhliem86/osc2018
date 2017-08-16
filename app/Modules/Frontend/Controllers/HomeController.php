<?php namespace App\Modules\Frontend\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Promotion;
use App\Models\Testimonial;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	
	public function getIndex(){
		$promotion = Promotion::select('name','slug','description','img_avatar','img_icon')->where('status',1)->orderBy('order','DESC')->get();
		$testimonial = Testimonial::select('id','slug','title','author','description','img_slides','img_avatar','content')->where('status',1)->orderByRaw('RAND()')->take(2)->get();
		return view('Frontend::pages.home',compact('promotion','testimonial'));
	}

}

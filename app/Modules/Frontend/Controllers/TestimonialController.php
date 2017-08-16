<?php namespace App\Modules\Frontend\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;
use App\Models\Tour;
use App\Models\Promotion;

class TestimonialController extends Controller {

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
	protected $testimonial;

	public function __construct(Testimonial $testimonial){
		$this->testimonial = $testimonial;
	}

	public function getTestimonial(){
		$testimonial_list = $this->testimonial->select('id','title','slug','description','author','img_avatar','img_slides')->where('status',1)->orderBy('order','DESC')->get();
		$testimonial_focus = $this->testimonial->select('id','title','slug','description','author','img_avatar','img_slides')->where('status',1)->where('focus',1)->orderBy('order','DESC')->first();
		return view('Frontend::pages.testimonial',compact('testimonial_list','testimonial_focus'));
	}

	public function getTestimonialDetail($slug = null){
		if($slug != null){
			$testimonial_detail = $this->testimonial->select('id','title','content','img_slides','author')->where('slug',$slug)->first();
			$testimonial_relate = $this->testimonial->select('id','author','description','slug','img_avatar')->whereNotIn('id',[$testimonial_detail->id])->where('status',1)->get();
			$tour_rec = Tour::select('id','slug','title','country_id')->orderByRaw("RAND()")->where('status',1)->take(4)->get();
			$promotion_rand = Promotion::select('id','slug','name','description')->where('status',1)->orderByRaw('RAND()')->first();
			return view('Frontend::pages.testimonial-detail',compact('testimonial_detail','testimonial_relate','tour_rec','promotion_rand'));
		}else{
			return redirect()->back();
		}
	}


}

<?php namespace App\Modules\Frontend\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Promotion;

class PromotionController extends Controller {

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
	protected $promotion;

	public function __construct(Promotion $promotion){
		$this->promotion = $promotion;
	}
	public function getPromotion(){

		// $country_list = Country::list('name','id');
		$promotion_list = $this->promotion->select('id','name','description','content','img_avatar')->where('status',1)->orderBy('order','DESC')->get();
		$promotion_rand = $this->promotion->select('id','name','description')->where('status',1)->orderByRaw("RAND()")->first();
		return view('Frontend::pages.promotion',compact('promotion_list','promotion_rand'));
	}

}

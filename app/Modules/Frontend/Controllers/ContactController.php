<?php namespace App\Modules\Frontend\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Modules\Frontend\Requests\ContactRequest;
use App\Models\Register;
use App\Models\Location;
use App\Models\Promotion;

class ContactController extends Controller {

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
		return view('Frontend::pages.contact',compact('promotion'));
	}

	public function postRegister(ContactRequest $contactrequest){
		$type = explode('@',$contactrequest->input('content_type'));
		$content_type = $type['1'];
		$data = [
			'fullname'=> $contactrequest->input('name'),
			'phone'=> $contactrequest->input('phone'),
			'email'=> $contactrequest->input('email'),
			'id_city'=> $contactrequest->input('id_city'),
			'id_center'=> $contactrequest->input('id_center'),
			'country'=> $contactrequest->input('country'),
			'content_type'=> $content_type,
			'inquiry'=> $contactrequest->input('inquiry'),
			'id_hash'=> $contactrequest->input('id_hash'),
		];
		\DB::connection('mysql2')->table('lp_register_summer_2017')->insert($data);
		// Register::create($data);

		\Session::flash('status','success');
		return redirect()->route('contact.thankyou');
		// return redirect()->back()->with('success','Cảm ơn bạn đã đăng ký thông tin tại ILA Du học.<br/>Nhân viên ILA sẽ liên lạc với bạn trong thời gian sớm nhất.');
	}

	public function postAjaxCenter(Request $request){
		if(!$request->ajax()){

		}else{
			$id_city = $request->input('data');
			$id_center = Location::where('id_city',$id_city)->select('id_center')->first()->id_center;
			return response()->json(['rs'=>$id_center]);
		}
	}

	public function getThankyou(){
		if(\Session::has('status') && \Session::get('status') == 'success'){
			return view('Frontend::pages.thank-you');
		}else{
			return redirect()->route('home');
		}

	}

}

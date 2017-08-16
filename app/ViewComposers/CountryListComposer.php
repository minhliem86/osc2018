<?php namespace App\ViewComposers;

use Illuminate\Contracts\View\View;

use App\Models\Country;
use App\Models\Promotion;

class CountryListComposer {
	  /**
	* Create a new  composer.
	* @return void
	*/
	
	protected $country;

	public function __construct(Country $country) {
		$this->country = $country;
	}

	/**
	* Bind data to the view.
	*
	* @param  View  $view
	* @return void
	*/
	public function compose(View $view) {
		$countries = $this->country->all();
		$list_a_country = $this->country->select('id','name','img_avatar','slug')->where('multi_countries','0')->where('home_show',1)->orderByRaw('RAND()')->take(4)->get();
		$list_multi_country = $this->country->select('id','name','img_avatar','slug')->where('multi_countries',1)->where('home_show',1)->orderBy('order','DESC')->take(3)->get();
		$ul_list = $this->country->select('id','name','slug')->where('multi_countries','1')->orderBy('order','DESC')->get();
		$promotion = Promotion::select('name','slug','img_icon')->where('status',1)->orderBy('order','DESC')->get();

		$view->with(['list_a_country'=>$list_a_country,'list_multi_country'=>$list_multi_country,'ul_list'=>$ul_list,'countries'=>$countries,'promotion'=>$promotion]);
	}
}
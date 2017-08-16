<?php namespace App\ViewComposers;

use Illuminate\Contracts\View\View;

use App\Models\Country;
use App\Models\Location;

class FormViewComposer {
	  /**
	* Create a new  composer.
	* @return void
	*/
	
	protected $country;
	protected $location;

	public function __construct(Country $country, Location $location ) {
		$this->country = $country;
		$this->location = $location;
	}

	/**
	* Bind data to the view.
	*
	* @param  View  $view
	* @return void
	*/
	public function compose(View $view) {
		$country_list = Country::lists('name','name');
		$location_list = Location::select('title','id_city')->lists('title','id_city');
		$view->with(['country_list'=>$country_list,'location_list'=>$location_list]);
	}
}
<?php namespace App\ViewComposers;

use Illuminate\Contracts\View\View;

use App\Models\Country;
use App\Models\Image;

class MyViewComposer {
	  /**
	* Create a new  composer.
	* @return void
	*/
	
	protected $country;
	protected $image;

	public function __construct(Country $country, Image $image ) {
		$this->country = $country;
		$this->image = $image;
	}

	/**
	* Bind data to the view.
	*
	* @param  View  $view
	* @return void
	*/
	public function compose(View $view) {
		// Code here 
		$country_data = $this->country->all();
		$view->with('country', $country_data);

		/*GET BANNER IMAGE*/
		$banner_img = $this->image->where('type','banner')->orderBy('order','DESC')->get();
		$view->with('banner',$banner_img);
	}
}
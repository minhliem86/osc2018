<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class ImageRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'img' =>'mimes:jpeg,bmp,png|max:1000'
		];
	}
	public function messages(){
		return [
			'img.max' => 'File size must below 1mb',
		];
	}

}

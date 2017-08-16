<?php

Route::group(['namespace'=>'App\Modules\Frontend\Controllers'],function(){
	Route::get('/',['as'=>'home','uses'=>'HomeController@getIndex']);

	Route::get('du-hoc-{slug?}',['as'=>'quocgia','uses'=>'DestinationController@getCountry'])->where(['slug'=>'[0-9a-zA-Z.\-]+']);
	Route::get('du-hoc-{slugcountry}/{slugtour?}',['as'=>'quocgia.detail','uses'=>'DestinationController@getTour'])->where(['slugcountry'=>'[0-9a-zA-Z.\-]+','slugtour'=>'[0-9a-zA-Z.\-]+']);

	Route::get('khuyen-mai',['as'=>'khuyenmai','uses'=>'PromotionController@getPromotion']);

	Route::get('trai-nghiem-du-hoc',['as'=>'trainghiem','uses'=>'TestimonialController@getTestimonial']);
	Route::get('trai-nghiem-du-hoc/{slug}',['as'=>'trainghiem.detail','uses'=>'TestimonialController@getTestimonialDetail'])->where(['slug'=>'[a-zA-Z0-9.\-]+']);

	Route::get('lien-he',['as'=>'contact','uses'=>'ContactController@getIndex']);
	Route::get('thank-you',['as'=>'contact.thankyou','uses'=>'ContactController@getThankyou']);
	Route::post('lien-he',['as'=>'contact.postRegister','uses'=>'ContactController@postRegister']);
	Route::post('ajaxCenter',['as'=>'contact.postAjaxCenter','uses'=>'ContactController@postAjaxCenter']);

	// IMPORT USER
	Route::get('/import-user',['as' => 'f.importUser', 'uses'=>'ImportController@index']);
	Route::post('/import-user', ['as'=>'f.postImportUser', 'uses'=>'ImportController@postImportUser']);

	// CUSTOMER LOGIN
	Route::get('/travel-blog',['as'=>'f.getLoginCustomer', 'uses'=>'Auth\AuthController@getLogin']);
	Route::post('/dang-nhap',['as'=>'f.postLoginCustomer', 'uses'=>'Auth\AuthController@postLogin']);
	Route::get('/dang-xuat',['as'=>'f.getLogoutCustomer', 'uses'=>'Auth\AuthController@getLogout']);

	Route::get('/thay-doi-mat-khau', ['middleware'=>'customer_login_not_yet','as'=>'f.getChangePass', 'uses' => 'Auth\AuthController@getChangePass']);
	Route::post('/thay-doi-mat-khau', ['middleware'=>'customer_login_not_yet','as'=>'f.postChangePass', 'uses' => 'Auth\AuthController@postChangePass']);

	Route::get('/sendEmailReset',['as'=>'f.getSendEmailReset','uses'=>'Auth\PasswordController@getEmail']);
	Route::post('/sendEmailReset',['as'=>'f.postSendEmailReset','uses'=>'Auth\PasswordController@postEmail']);
	Route::get('/resetPassword/{token?}',['as'=>'f.getresetPassword','uses'=>'Auth\PasswordController@getReset']);
	Route::post('/resetPassword',['as'=>'f.postresetPassword','uses'=>'Auth\PasswordController@postReset']);


	Route::get('/thu-vien-hinh-anh', ['middleware'=>'customer_login_not_yet', 'as' =>'f.album', 'uses' => 'CustomerController@getAlbum']);
	Route::get('/get-Album', ['middleware'=>'customer_login_not_yet',  'as' =>'f.ajaxAlbum', 'uses' => 'CustomerController@ajaxLoadAlbum']);
	Route::get('thu-vien-hinh-anh/{slug_album}/photo', ['middleware'=>'customer_login_not_yet', 'as' => 'f.photo', 'uses' => 'CustomerController@getPhotoByAlbum'])->where('slug_album','[0-9A-Za-z._\-]+');
	Route::get('/travel-blog/hinh-anh-{id}',['as' =>'f.hinhanh', 'uses' => 'CustomerController@getHinhanhDetail'])->where('id','[0-9]+');

	Route::group(['middleware'=>'check_super_user'], function(){
			Route::get('/super-user-thu-vien-hinh-anh', ['as' => 'f.superAlbum', 'uses'=>'CustomerController@getAlbumSuper']);
			Route::get('/super-user-thu-vien-hinh-anh/{album_id}/{slug_album}/photo', ['as' => 'f.superAlbumPhoto', 'uses'=>'CustomerController@getSuperPhotoByAlbum']);
			Route::get('/loadAlbum', ['as' => 'f.ajaxLoadAlbum', 'uses' => 'CustomerController@ajaxGetAlbum']);

			Route::get('/super-user-album-{album_id}', ['as' => 'f.showAlbumBySuper', 'uses' => 'CustomerController@getAlbumBySuper'])->where('album_id', '[0-9]+');

			// GA FETCH
			Route::get('/report', ['as'=>'f.reportBySuper', 'uses' => 'GAController@index']);
	});

	// Route::get('/create-super', function(){
	// 	$data = [
	// 		'name' => 'Tester Travel Blog',
	// 		'username' => 'admin-travelblog',
	// 		'password' => bcrypt('ila@osc'),
	// 		'tour_id' =>1,
	// 		'super' => 1,
	// 	];
	//
	// 	App\Models\Customer::create($data);
	//
	// 	return "done";
	// });
});

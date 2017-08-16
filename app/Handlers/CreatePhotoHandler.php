<?php namespace App\Handlers;

use App\Events\PhotoWasUploaded;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use App\Models\Photo;

class CreatePhotoHandler {

	/**
	 * Create the event handler.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Handle the event.
	 *
	 * @param  PhotoWasUploaded  $event
	 * @return void
	 */

	public function handle(PhotoWasUploaded $event)
	{
		$photo = Photo::create($event->data);
	}

}

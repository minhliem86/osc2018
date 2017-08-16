<?php namespace App\Handlers;

use App\Events\PhotoWasDeleted;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use App\Models\Photo;

class DeletePhotoHandler {

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
	 * @param  PhotoWasDeleted  $event
	 * @return void
	 */
	public function handle(PhotoWasDeleted $event)
	{
		$img = Photo::destroy($event->id);
	}

}

<?php namespace App\Events;

use App\Events\Event;

use Illuminate\Queue\SerializesModels;

class PhotoWasDeleted extends Event {

	use SerializesModels;

	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	 public $id;
	public function __construct($id)
	{
		$this->id = $id;
	}

}

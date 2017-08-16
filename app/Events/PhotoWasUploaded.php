<?php namespace App\Events;

use App\Events\Event;

use Illuminate\Queue\SerializesModels;

class PhotoWasUploaded extends Event {

	use SerializesModels;

	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	 public $original_name;
	 public $filename_with_extension;
	 public $data;

	public function __construct($original_name, $filename_with_extension, $data)
	{
		$this->original_name = $original_name;
		$this->filename_with_extension = $filename_with_extension;
		$this->data = $data;
	}

}

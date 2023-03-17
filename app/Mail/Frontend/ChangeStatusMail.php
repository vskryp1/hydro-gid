<?php

namespace App\Mail\Frontend;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Log;

class ChangeStatusMail extends Mailable
{
    use Queueable, SerializesModels;

	private $data;
	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct($data)
	{
		$this->data = $data;
	}

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
	    if (isset($this->data['locale'])) {
		    \App::setLocale($this->data['locale']);
	    }
	    return $this->view('frontend.mails.change_status.index')->with($this->data)->subject(__('mails.subject_change_status'));
    }
}

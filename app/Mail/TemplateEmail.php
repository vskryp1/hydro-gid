<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TemplateEmail extends Mailable
{
    use Queueable, SerializesModels;

    public  $body;
    public  $subject;
    private $recipient;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($body, $subject, $recipient)
    {
        $this->body = $body;
        $this->subject = $subject;
        $this->recipient = $recipient;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('frontend.mails.news_letter.index')
            ->with(['body' => $this->body, 'subscriber' => $this->recipient])
            ->subject($this->subject);
    }
}

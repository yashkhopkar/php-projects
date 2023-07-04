<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PhotoEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $data = [];
    public $from =[];

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        $subject = 'Photo Email';
        $view = 'emails.photo-email';
        $data = $this->data;
        //$this.from('test@test.com', 'Test');

        return $this->subject($subject)
                    ->view($view, $data);
                    //->from()
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Photo Email',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'email-success',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}

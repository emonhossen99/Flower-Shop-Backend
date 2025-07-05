<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;
    public $contactMessage;

    public function __construct($message)
    {
        $this->contactMessage = $message;
    }

    public function build()
    {
        return $this->view('emails.contactmail')
            ->subject('Contact Mail')
            ->with(['contactMessage' => $this->contactMessage]); // Use the renamed variable
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}

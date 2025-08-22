<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ClinicUserAccountMail extends Mailable
{
    use Queueable, SerializesModels;
    public $user_account;
    public $user_default_password;

    /**
     * Create a new message instance.
     */
    public function __construct($user_account, $user_default_password)
    {
        $this->user_account = $user_account;
        $this->user_default_password = $user_default_password;
    }
 

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Clinic User Account and Default Password',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'ClinicUser.emails.clinic-user-account-mail',
            with: [
                'user_account' => $this->user_account,
                'user_default_password' => $this->user_default_password,
            ]
        );
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

<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;
		public $user;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Protótipo de automação de envio de E-mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
			return new Content(
				view: 'emails.email',
				with: [
				'verifyEmailLink'=>config('app.url') . '/api/auth/verify-email?token=' . $this->user->confirmation_token
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
        return [
					
				];
    }
}

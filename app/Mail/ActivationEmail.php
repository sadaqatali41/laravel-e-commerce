<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class ActivationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    
    public function envelope()
    {
        return new Envelope(
            subject: 'Laravel-9 Ecommerce : Activation Email',
        );
    }


    public function content()
    {
        $activationUrl = route('user.activate', $this->user->activation_token);

        return new Content(
            view: 'emails.activation',
            with: [
                'activationUrl' => $activationUrl
            ]
        );
    }

    public function attachments()
    {
        return [];
    }
}

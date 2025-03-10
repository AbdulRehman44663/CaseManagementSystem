<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ClientVerificationEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $verificationUrl;

    public function __construct($user, $verificationUrl)
    {
        $this->user = $user;
        $this->verificationUrl = $verificationUrl;
    }

    public function build()
    {
        $email = $this->subject('CaseManagementSystem New User - Please confirm your email and get access.')->view('components.emails.client-verification-email')
            ->with(['verificationUrl' => $this->verificationUrl, 'user' => $this->user]);
            
        return $email->to($this->user->email);
    }

     
}

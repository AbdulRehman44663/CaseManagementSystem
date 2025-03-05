<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PasswordResetMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $resetPasswordLink;
    public function __construct($user, $resetPasswordLink)
    {
        $this->user = $user;
        $this->resetPasswordLink = $resetPasswordLink;
    }

    public function build()
    {
        $email = $this->subject('CaseManagementSystem - Password Change Request')->view('components.emails.reset-password-email')
            ->with(['user' => $this->user, 'reset_link' => $this->resetPasswordLink]);
            
        return $email->to($this->user->email);
    }
}

<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Mail\PasswordResetMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendPasswordResetEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;
    public $resetPasswordLink;

    /**
     * Create a new job instance.
     */
    public function __construct($user, $resetPasswordLink)
    {
        $this->user = $user;
        $this->resetPasswordLink = $resetPasswordLink;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::send(new PasswordResetMail($this->user, $this->resetPasswordLink));
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ClientEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $email_body;
    public $file;
    public $email_from;
   
    public $subject;
    public $email;
    
    public function __construct($email_body, $file, $email_from, $subject, $email)
    {
        $this->email_body = $email_body;
        $this->file = $file;
        $this->email_from = $email_from;
        $this->subject = $subject;
        $this->email = $email;
    }

    public function build()
    {
        $email = $this->subject($this->subject)
            ->view('admin.components.emails.client-email')
            ->with(['email_body' => $this->email_body]);

        if ($this->file && is_array($this->file)) {
            foreach ($this->file as $filePath) {
                $email->attach($filePath, [
                    'as' => basename($filePath),
                    'mime' => mime_content_type($filePath),
                ]);
            }
        }
        return $email->from($this->email_from)->to($this->email->to);
    }
}

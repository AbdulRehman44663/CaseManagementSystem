<?php

namespace App\Jobs;

use App\Mail\ClientEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\ClientEmail as ModelsClientEmail;

class SendClientEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $email_body;
    public $file;
    public $email_from;
    public $email_to;
    public $subject;
    public $email;

    public function __construct($email_body, $file, $email_from, $email_to, $subject, $email)
    {
        $this->email_body = $email_body;
        $this->file = $file;
        $this->email_from = $email_from;
        $this->email_to = $email_to;
        $this->subject = $subject;
        $this->email = $email;
    }

    public function handle()
    {
        //$email = new ClientEmail($this->email_body, $this->file, $this->email_from, $this->email_to, $this->subject);
        //Mail::send($email);
        try{
            Mail::send(new ClientEmail($this->email_body, $this->file, $this->email_from, $this->subject, $this->email));

            if($this->email)
            {
                ModelsClientEmail::where('id', $this->email->id)->update([
                    'last_time_re_sent' =>  date('Y-m-d H:i:s'),
                    'time_resent' => $this->email->time_resent + 1, 
                ]);
            }
        }
        catch (\Exception $e) {
            Log::error("Email sending failed: {$e->getMessage()}");
            //dd("Email sending failed: " . $e->getMessage());
        }
    }
}

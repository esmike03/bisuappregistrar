<?php

// App/Mail/VerificationEmail.php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerificationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $verificationCode;

    public function __construct($verificationCode)
    {
        $this->verificationCode = $verificationCode;
    }

    public function build()
    {
        return $this->subject('Email Verification Code')
                    ->view('mails.verification') // Specify your email view
                    ->with(['code' => $this->verificationCode]); // Pass data to the view
    }
}

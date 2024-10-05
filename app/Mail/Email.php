<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Email extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct()
    {
        // You can pass data to the constructor if needed
    }

    public function build()
    {
        return $this->subject('Your Email Subject')
                    ->view('mails.Mail');  // Point to your email view
    }
}


<?php

namespace App\Http\Controllers;

use App\Mail\Email;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendEmail()
    {
        Mail::to('sarabiaearlmike14@gmail.com')->send(new Email());

        return 'Email sent successfully!';
    }
}


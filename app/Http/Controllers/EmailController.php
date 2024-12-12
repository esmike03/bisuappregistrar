<?php

namespace App\Http\Controllers;

use App\Mail\Email;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendEmail()
    {
        try {
            Mail::to('sarabiaearlmike14@gmail.com')->send(new Email());
            return redirect()->back()->with('success', 'Email sent successfully!');
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

}


<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    //
    public function message(Request $request)
    {
        // Validate the request data
        $formFields = $request->validate([
            'email' => 'required',
            'campus' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        // Save the data to the database without converting the date format
        Message::create($formFields);

        return redirect('/')->with('message', 'Message Send Successfully!');
    }

    public function emailuser(Request $request, $email, $subject, $message)
    {
        return view('admin.partials.email', compact('email', 'subject', 'message'));
    }

    public function sendEmailUser(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'email' => 'required|email',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);

        // Send the email
        Mail::to($request->email)->send(new ContactMail($request->subject, $request->message));

        return back()->with('success', 'Email sent successfully!');
    }

    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();

        return redirect()->back()->with('message', 'Message deleted successfully.');
    }
}

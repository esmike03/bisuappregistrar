<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

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


}

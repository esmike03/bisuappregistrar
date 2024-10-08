<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\VerificationEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class Verify extends Controller
{
    public function verify()
    {
        return view('appointment.verify');
    }

    public function sendemail()
    {
        return view('appointment.send-email');
    }


    public function sendVerificationCode(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Generate the verification code
        $verificationCode = rand(1000, 9999); // Example code generation

        // Store the email in the session
        Session::put('email', $request->email);
        // Store the verification code in the session
        Session::put('verification_code', $verificationCode);
        // Initialize attempts counter
        Session::put('verification_attempts', 0);

        // Send the email
        Mail::to($request->email)->send(new VerificationEmail($verificationCode));

        return redirect('/verify')->with(['message' => 'Verification code sent successfully.']);
    }

    public function verifyCode(Request $request)
    {
        // Validate the input
        $request->validate(['code' => 'required|array', 'code.*' => 'digits_between:0,9']);

        $expectedCode = session('verification_code'); // Get the expected code from the session
        $inputCode = implode('', $request->code); // Convert the input codes to a string
        $maxRetries = 3; // Maximum number of retries

        // Retrieve current attempts from the session
        $currentAttempts = session('verification_attempts', 0);

        // Log expected and input codes for debugging


        if ($inputCode == $expectedCode) {
            // Reset attempts on successful verification
            Session::forget('verification_attempts');
            Session::forget('verification_code'); // Clear the verification code from the session

            // Retrieve the email from the session
            $email = session('email');

            // Redirect to the appointment form and pass the email address
            return redirect('/appointment/form')->with([
                'message' => 'Verification successful!',
                'email' => $email, // Send the email to the appointment form
            ])->cookie('email', $email, 3);;
        } else {
            // Increment the attempts counter
            $currentAttempts++;
            Session::put('verification_attempts', $currentAttempts);

            if ($currentAttempts >= $maxRetries) {
                // Redirect to home if max retries exceeded
                Session::forget('verification_code'); // Clear the verification code from session
                Session::forget('verification_attempts'); // Clear the attempts
                return redirect('/send-email')->with('message', 'Maximum retries reached! Please try again!'); // Change '/' to your home route
            } else {
                // Calculate remaining retries
                $remainingRetries = $maxRetries - $currentAttempts;
                return back()->withErrors(['code' => 'The verification code is incorrect. You have ' . $remainingRetries . ' retries left.']);
            }
        }
    }
}

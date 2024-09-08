<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class HomeController extends Controller
{
    //Home
    public function index()
    {
        return view('appointment.index');
    }

    public function store(Request $request)
    {
        // Validate the form fields
        $formFields = $request->validate([
            'fName' => 'required',
            'lName' => 'required',
            'mName' => 'nullable', // Middle name can be optional
            'email' => 'required', // Ensure 'appointments' is the correct table name
            'ygrad' => 'nullable', // Optional field with reasonable range checks
            'ismis' => 'nullable', // Optional field, assuming ISMIS ID is numeric
            'status' => 'required', // Ensure 'status' is correctly validated
            'campus' => 'required', // Add validation for the campus field
            'request' => 'required', // Validate the request field
            'appdate' => 'required|date', // Ensure appdate is validated as a date
        ]);

        $formFields['fName'] = strtoupper($formFields['fName']);
        $formFields['lName'] = strtoupper($formFields['lName']);
        $formFields['mName'] = $formFields['mName'] ? strtoupper($formFields['mName']) : null;

        // Check if a record with the same fName and lName already exists
        $nameexists = Appointment::where('fName', $request->input('fName'))
            ->where('lName', $request->input('lName'))
            ->exists();

        // Corrected check for ISMIS existence
        $ismisexists = Appointment::where('ismis', $request->input('ismis'))
            ->exists();

        $emailexists = Appointment::where('email', $request->input('email'))
            ->exists();

        if ($nameexists) {
            // If the combination exists, return back with an error message
            return back()->withErrors(['duplicate' => 'We have found that this name is associated with a pending appointment.'])
                ->withInput(); // Keeps the current form input
        }

        if ($ismisexists) {
            // If ISMIS ID already exists, return back with an error message
            return back()->withErrors(['duplicate' => 'Please check your ISMIS ID.'])
                ->withInput(); // Keeps the current form input
        }

        if ($emailexists) {
            // If ISMIS ID already exists, return back with an error message
            return back()->withErrors(['duplicate' => 'We have found that this email address is associated with a pending appointment.'])
                ->withInput(); // Keeps the current form input
        }

        // Generate a unique 6-character tracking code
        do {
            $trackingCode = strtoupper(substr(uniqid(), -6)); // Generates a unique 6-character code
        } while (Appointment::where('tracking_code', $trackingCode)->exists()); // Ensure the code is unique

        // Add the generated tracking code to the form fields
        $formFields['tracking_code'] = $trackingCode;

        // Create the appointment with the form fields including the tracking code
        Appointment::create($formFields);

        return redirect('/')->with('formData', $formFields)->with('message', 'Appointment Set Successfully!');
    }



    //Show Appointment Form
    public function form()
    {
        return view('appointment.form');
    }


    public function search(Request $request)
    {
        $search_text = $request->query('query');
        $search_campus = $request->query('campus');

        // Fetch a single appointment
        $code = Appointment::where('tracking_code', 'LIKE', '%' . $search_text . '%')
            ->where('campus', 'LIKE', '%' . $search_campus . '%')
            ->first();
        if (!$code) {
            return back()->with('message', 'No record found.');
        }

        return view('appointment.track', compact('code'));
    }
}

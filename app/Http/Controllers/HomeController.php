<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Maximum;
use App\Events\RealTime;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\RejectedAppointment;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentConfirmation;

class HomeController extends Controller
{
    //Home
    public function index()
    {

        $posts = Post::paginate(3);

        return view('appointment.index', compact('posts'));
    }

    public function store(Request $request)
    {
        // Validate the form fields
        $formFields = $request->validate([
            'fName' => 'required',
            'lName' => 'required',
            'mName' => 'nullable', // Middle name can be optional
            'suffix' => 'nullable',
            'email' => 'required', // Ensure 'appointments' is the correct table name
            'ygrad' => 'nullable', // Optional field with reasonable range checks
            'ismis' => 'nullable', // Optional field, assuming ISMIS ID is numeric
            'status' => 'required', // Ensure 'status' is correctly validated
            'campus' => 'required', // Add validation for the campus field
            'course' => 'required',
            'reason' => 'nullable',

            'copy' => 'required',
            'request' => 'required|array', // Validate the request field
            'request.*' => 'string',
            'appdate' => 'required|date', // Ensure appdate is validated as a date
        ]);

        // Convert names to uppercase
        $formFields['fName'] = strtoupper($formFields['fName']);
        $formFields['lName'] = strtoupper($formFields['lName']);
        $formFields['mName'] = $formFields['mName'] ? strtoupper($formFields['mName']) : null;

        // Check if a record with the same fName and lName already exists
        $nameExists = Appointment::where('fName', $request->input('fName'))
            ->where('lName', $request->input('lName'))
            ->exists();

        $emailExists = Appointment::where('email', $request->input('email'))
            ->where('appstatus', 'pending') // Only check for pending status
            ->exists();

        if ($nameExists) {
            // If the combination exists, return back with an error message
            return back()->withErrors(['duplicate' => 'We have found that this name is associated with a pending appointment.'])
                ->withInput(); // Keeps the current form input
        }

        if ($emailExists) {
            // If the email already exists, return back with an error message
            return back()->withErrors(['duplicate' => 'We have found that this email address is associated with a pending appointment.'])
                ->withInput(); // Keeps the current form input
        }

        // Check if there are already 10 appointments on the same date
        $appointmentCount = Appointment::whereDate('appdate', $request->input('appdate'))
            ->where('campus', $request->input('campus'))
            ->where('appdate', $request->input('appdate')) // Only count pending appointments
            ->count();

        $max = Maximum::where('campus', $request->input('campus'))->first();
        $numAsInteger = (int) $max->num;

        if ($appointmentCount >= $numAsInteger) {
            // Return an error if there are already 10 appointments
            return back()->withErrors(['datefull' => 'We apologize, but the maximum appointments for the chosen date has been reached. Kindly choose another date for your appointment.'])
                ->withInput(); // Keeps the current form input
        }

        // Generate a unique 6-character tracking code
        do {
            $trackingCode = strtoupper(substr(uniqid(), -6)); // Generates a unique 6-character code
        } while (Appointment::where('tracking_code', $trackingCode)->exists()); // Ensure the code is unique

        // Add the generated tracking code to the form fields
        $formFields['tracking_code'] = $trackingCode;

        // Handle the request (multiple select field) by concatenating it into a string before saving
        $formFields['request'] = implode(', ', $request->input('request')); // Convert array to a comma-separated string for storage


        // Create the appointment with the form fields including the tracking code
        $appointment = Appointment::create($formFields);

        if ($request->hasFile('picture')) {
            // Store the file and get its path
            $path = $request->file('picture')->store('uploads', 'public');
            $appointment->picture = $path; // Save the path to the 'picture' column
            // Save other fields as needed...
            $appointment->save();
        }

        // Prepare data for the email
        $data = $request->only(['fName', 'lName', 'email', 'status', 'campus', 'appdate']);
        $data['tracking_code'] = $trackingCode;
        $data['request'] = implode(', ', $request->input('request')); // Convert array back to a string for the email


        // Send confirmation email
        Mail::to($request->email)->send(new AppointmentConfirmation($data));

        return redirect('/')->with('formData', $formFields)->with('message', 'Appointment Set Successfully!')->withoutCookie('email');
    }

    //Show Appointment Form
    public function form()
    {
        // Check if the email exists in the session
        $email = request()->cookie('email');

        if (empty($email)) {
            // Redirect to home if email is not found in cookie
            return redirect('/send-email')->with('message', 'Please complete email verification first.');
        }

        // Store it in the session for easy access later (optional)
        session(['email' => $email]);

        // Proceed to show the appointment form
        return view('appointment.form');
    }


    // Search appointment
    public function search(Request $request)
    {
        $search_text = $request->query('query');
        $search_campus = $request->query('campus');

        // Try to find an appointment in both models
        $code = Appointment::where('tracking_code', 'LIKE', '%' . $search_text . '%')
            ->where('campus', 'LIKE', '%' . $search_campus . '%')
            ->first();

        if (!$code) {
            // If not found in Appointment, search in RejectedAppointment
            $code = RejectedAppointment::where('tracking_code', 'LIKE', '%' . $search_text . '%')
                ->where('campus', 'LIKE', '%' . $search_campus . '%')
                ->first();
        }

        // If still not found, return with a message
        if (!$code) {
            return back()->with('message', 'No record found.');
        }

        // Pass the found appointment to the view
        return view('appointment.track', compact('code'));
    }

    //Show edit Appointment
    public function edit(Request $request, $tracking_code)
    {
        // Fetch a single appointment by tracking_code
        $code = Appointment::where('tracking_code', $tracking_code)->first();
        $req = explode(', ', $code->request);
        // If no appointment found, return with a message
        if (!$code) {
            return back()->with('message', 'Appointment not found.');
        }

        return view('appointment.edit', compact('code', 'req'));
    }

    public function update(Request $request, $code)
    {
        // Find the appointment by tracking code
        $appointment = Appointment::where('tracking_code', $code)->firstOrFail();

        // Validate the incoming request data
        $formFields = $request->validate([
            'fName' => 'required',
            'lName' => 'required',
            'mName' => 'nullable',
            'email' => 'required',
            'ygrad' => 'nullable',
            'ismis' => 'nullable',
            'status' => 'required',
            'campus' => 'required',
            'request' => 'required',
            'appdate' => 'required|date',
        ]);

        // Dump the form fields and the current appointment instance for debugging

        $formFields['request'] = implode(', ', $formFields['request']);
        // Perform the update operation
        $appointment->update($formFields);

        // Optionally dump the updated appointment for debugging

        // Redirect with a success message
        return redirect('/')->with('message', 'Appointment Updated Successfully!');
    }
}

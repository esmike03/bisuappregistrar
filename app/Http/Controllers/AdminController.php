<?php

namespace App\Http\Controllers;

use App\Mail\ReadyMail;
use App\Models\Holiday;
use App\Models\Maximum;
use App\Models\Message;
use App\Mail\RejectMail;
use App\Mail\ApprovedMail;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Models\RejectedAppointment;
use App\Models\CompletedAppointment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentConfirmation;

class AdminController extends Controller
{
    //
    //Home
    public function admin()
    {
        if (auth()->guard('admin')->check()) {
            return redirect('/admin/dashboard')->with('message', 'Already log in to this page.'); // Change 'dashboard' to the name of your dashboard route
        }
        return view('admin.login.admin-index');
    }

    public function settings(Request $request)
    {
        $campus = auth()->guard('admin')->user()->campus;

        $maximum = Maximum::where('campus', $campus)->first();

        return view('admin.partials.settings', compact('maximum'));
    }

    public function dashboard(Request $request)
    {
        if (!auth()->guard('admin')->check()) {
            // Redirect to the login page if not authenticated
            return redirect('/admin')->with('message', 'Please log in to access this page.');
        }

        $category = auth()->guard('admin')->user()->campus; // Get the category for the current admin

        $appointmentCount = Appointment::where('campus', $category)
            ->where('appstatus', 'pending')
            ->count();
        $approvedCount = Appointment::where('campus', $category)
            ->where('appstatus', 'approved')
            ->count();
        $completedCount = CompletedAppointment::where('campus', $category)
            ->where('appstatus', 'COMPLETED')
            ->count();

        // Initialize the query
        $query = Appointment::where('campus', $category);

        // Check for search input and filter by tracking_code
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where('tracking_code', 'LIKE', "%{$searchTerm}%");
        }

        $messages = Message::all();

        // Paginate the filtered appointments
        $appointments = $query->orderBy('created_at', 'desc')->paginate(100); // Adjust the number of items per page as needed


        return view('admin.dashboard', ['appointments' => $appointments, 'completedCount' => $completedCount, 'appointmentCount' => $appointmentCount, 'approvedCount' => $approvedCount, 'messages' => $messages,]);
    }



    //Authenticate admin
    public function authenticate(Request $request)
    {

        $formFields = $request->validate([
            'campus' => 'required',
            'password' => 'required'
        ]);

        // Attempt to authenticate using the admin guard
        if (Auth::guard('admin')->attempt($formFields)) {
            $request->session()->regenerate();
            return redirect('/admin/dashboard')->with('message', 'Logged In!');
        }

        return back()->with('message', 'Invalid credentials!')->onlyInput('campus');
    }

    //logout admin
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin')->with('message', 'You have been logout!');
    }

    public function records()
    {
        if (!auth()->guard('admin')->check()) {
            // Redirect to the login page if not authenticated
            return redirect('/admin')->with('message', 'Please log in to access this page.');
        }

        $category = auth()->guard('admin')->user()->campus; // Get the category for the current admin

        // Paginate holidays
        $holidays = Holiday::paginate(10); // Adjust the number 10 to the number of items per page

        return view('admin.partials.records', [
            'holidays' => $holidays, // Pass the holidays data to the view
        ]);
    }


    //completed page
    public function completed(Request $request)
    {
        if (!auth()->guard('admin')->check()) {
            // Redirect to the login page if not authenticated
            return redirect('/admin')->with('message', 'Please log in to access this page.');
        }

        $category = auth()->guard('admin')->user()->campus; // Get the category for the current admin

        $appointmentCount = CompletedAppointment::where('campus', $category)
            ->where('appstatus', 'COMPLETED')
            ->count();

        // Paginate the appointments with filtering by category
        $appointments = CompletedAppointment::where('campus', $category)
            ->paginate(3); // Adjust the number of items per page as needed

        // Initialize the query
        $query = CompletedAppointment::where('campus', $category);

        // Check for search input and filter by tracking_code
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where('tracking_code', 'LIKE', "%{$searchTerm}%");
        }
        // Paginate the filtered appointments
        $appointments = $query->orderBy('created_at', 'desc')->paginate(100); // Adjust the number of items per page as needed
        $requestCounts = [];

        // Loop through appointments and split each request into individual items
        foreach ($appointments as $appointment) {
            $requests = explode(',', $appointment->request); // Assuming requests are comma-separated
            foreach ($requests as $req) {
                $req = trim($req); // Trim any extra spaces
                if (!empty($req)) {
                    if (isset($requestCounts[$req])) {
                        $requestCounts[$req]++;
                    } else {
                        $requestCounts[$req] = 1;
                    }
                }
            }
        }

        return view('admin.partials.completed', ['requestCounts' => $requestCounts, 'appointments' => $appointments, 'appointmentCount' => $appointmentCount]);
    }


    public function generatePDF()
    {
        $category = auth()->guard('admin')->user()->campus;

        $appointments = CompletedAppointment::where('campus', $category)
            ->where('appstatus', 'COMPLETED')
            ->get();

        $requestCounts = [];

        foreach ($appointments as $appointment) {
            $requests = explode(',', $appointment->request);
            foreach ($requests as $req) {
                $req = trim($req);
                if (!empty($req)) {
                    $requestCounts[$req] = isset($requestCounts[$req]) ? $requestCounts[$req] + 1 : 1;
                }
            }
        }

        $pdf = Pdf::loadView('admin.partials.completed_pdf', compact('requestCounts', 'appointments'));
        return $pdf->download('AppointmentReport.pdf');
    }

    //archive page
    public function archive(Request $request)
    {
        if (!auth()->guard('admin')->check()) {
            // Redirect to the login page if not authenticated
            return redirect('/admin')->with('message', 'Please log in to access this page.');
        }
        $category = auth()->guard('admin')->user()->campus; // Get the category for the current admin

        $appointmentCount = RejectedAppointment::where('campus', $category)
            ->where('appstatus', 'REJECTED')
            ->count();

        // Paginate the appointments with filtering by category
        $appointments = RejectedAppointment::where('campus', $category)
            ->paginate(3); // Adjust the number of items per page as needed

        // Initialize the query
        $query = RejectedAppointment::where('campus', $category);

        // Check for search input and filter by tracking_code
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where('tracking_code', 'LIKE', "%{$searchTerm}%");
        }

        // Paginate the filtered appointments
        $appointments = $query->orderBy('created_at', 'desc')->paginate(100); // Adjust the number of items per page as needed

        return view('admin.partials.archive', ['appointments' => $appointments, 'appointmentCount' => $appointmentCount]);
    }

    //approved page
    public function approved(Request $request)
    {
        if (!auth()->guard('admin')->check()) {
            // Redirect to the login page if not authenticated
            return redirect('/admin')->with('message', 'Please log in to access this page.');
        }
        $category = auth()->guard('admin')->user()->campus; // Get the category for the current admin

        $appointmentCount = Appointment::where('campus', $category)
            ->where('appstatus', 'Ready to Pick-up')
            ->count();

        // Paginate the appointments with filtering by category
        $appointments = Appointment::where('campus', $category)
            ->orderBy('created_at', 'desc')
            ->paginate(3); // Adjust the number of items per page as needed

        // Initialize the query
        $query = Appointment::where('campus', $category);

        // Check for search input and filter by tracking_code
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where('tracking_code', 'LIKE', "%{$searchTerm}%");
        }

        // Paginate the filtered appointments
        $appointments = $query->orderBy('created_at', 'desc')->paginate(100); // Adjust the number of items per page as needed
        return view('admin.partials.approved', ['appointments' => $appointments, 'appointmentCount' => $appointmentCount]);
    }


    //Delete Table row/ appointments
    public function destroy($id)
    {

        $appointment = Appointment::findOrFail($id);

        // Move data to the rejectedtable
        RejectedAppointment::create([
            'fname' => $appointment->fname,
            'lname' => $appointment->lname,
            'mname' => $appointment->mname,
            'suffix' => $appointment->suffix,
            'email' => $appointment->email,
            'ygrad' => $appointment->ygrad,
            'ismis' => $appointment->ismis,
            'campus' => $appointment->campus,
            'status' => $appointment->status,
            'appdate' => $appointment->appdate,
            'appstatus' => 'DELETED', // Set the correct status
            'request' => $appointment->request,
            // Properly formatted date
            'tracking_code' => $appointment->tracking_code,
        ]);
        $appointment->delete();

        return redirect('/admin/dashboard')->with('message', 'Appointment deleted successfully.');
    }

    //Delete Table row/ appointments
    public function destroyer($id)
    {

        $appointment = RejectedAppointment::findOrFail($id);

        $appointment->delete();

        return redirect('/admin/dashboard')->with('message', 'Appointment deleted successfully.');
    }

    //Approved Appointment
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'reason' => 'required|min:5|max:100',
        ]);

        $reason = $request->input('reason');

        // Find the appointment using the provided ID
        $appointment = Appointment::findOrFail($id);

        // Update the appointment status
        $appointment->update([
            'appstatus' => $request->input('appstatus'),
        ]);

        // Prepare data for the email using the appointment data
        $data = [
            'fName' => $appointment->fName,
            'lName' => $appointment->lName,
            'email' => $appointment->email,
            'status' => $appointment->appstatus,  // Updated status
            'campus' => $appointment->campus,
            'request' => $appointment->request,
            'appdate' => $appointment->appdate,
        ];

        $reason = [
            'email' => $appointment->email,
            'reason' => $request->input('reason'),
        ];

        // Check if appstatus is 'rejected' before sending the email
        if ($request->input('appstatus') === 'rejected') {
            // Store the reason in the session
            session(['reason' => $reason['reason']]);
            // Send rejected email
            Mail::to($reason['email'])->send(new RejectMail($reason));
            // Move data to the rejectedtable
            RejectedAppointment::create([
                'fname' => $appointment->fname,
                'lname' => $appointment->lname,
                'mname' => $appointment->mname,
                'suffix' => $appointment->suffix,
                'email' => $appointment->email,
                'ygrad' => $appointment->ygrad,
                'ismis' => $appointment->ismis,
                'campus' => $appointment->campus,
                'status' => $appointment->status,
                'appdate' => $appointment->appdate,
                'appstatus' => 'REJECTED', // Set the correct status
                'reason' => $request->input('reason'),
                'request' => $appointment->request,
                // Properly formatted date
                'tracking_code' => $appointment->tracking_code,
            ]);

            // Optionally delete the original appointment
            $appointment->delete();
        } else if ($request->input('appstatus') === 'approved') {
            // Send approved email
            Mail::to($data['email'])->send(new ApprovedMail($data));
        }

        session()->forget('reason');
        return redirect('/admin/dashboard')->with('message', 'Appointment status updated successfully.');
    }

    //Approved Appointment
    public function approvedStatus(Request $request, $id)
    {
        // Find the appointment using the provided ID
        $appointment = Appointment::findOrFail($id);

        // Update the appointment status
        $appointment->update([
            'appstatus' => $request->input('appstatus'),
        ]);

        // Prepare data for the email using the appointment data
        $data = [
            'fName' => $appointment->fName,
            'lName' => $appointment->lName,
            'email' => $appointment->email,
            'status' => $appointment->appstatus,  // Updated status
            'campus' => $appointment->campus,
            'request' => $appointment->request,
            'appdate' => $appointment->appdate,
        ];
        if ($request->input('appstatus') === 'approved') {
            // Send approved email
            Mail::to($data['email'])->send(new ApprovedMail($data));
        }
        return redirect('/admin/dashboard')->with('message', 'Appointment approved successfully.');
    }

    public function ready(Request $request, $id)
    {
        // Find the appointment or fail if not found
        $appointment = Appointment::findOrFail($id);

        // Update the appointment status
        $appointment->update([
            'appstatus' => 'Ready to Pick-up',
        ]);

        // Prepare the data for the email
        $data = [
            'fName' => $appointment->fName,
            'lName' => $appointment->lName,
            'email' => $appointment->email,
            'status' => $appointment->appstatus,  // Updated status
            'campus' => $appointment->campus,
            'request' => $appointment->request,
            'appdate' => $appointment->appdate,
        ];

        // Send ready to pickup email
        Mail::to($data['email'])->send(new ReadyMail($data));

        // Redirect to the correct route
        return redirect("/appointment/{$id}")->with('message', 'Appointment is Ready to Pick-up.');
    }



    //Show Appointment
    public function show(Appointment $appointment, Request $request)
    {

        return view('admin.partials.show', [
            'appointment' => $appointment,
        ]);
    }
    //Show Appointment
    public function showCompleted(CompletedAppointment $completed, Request $request)
    {

        return view('admin.partials.showCompleted', [
            'appointment' => $completed,
        ]);
    }
    public function deleteAll(Request $request)
    {
        $category = auth()->guard('admin')->user()->campus;

        // Delete all appointments that match the admin's category and have status REJECTED or DELETED
        RejectedAppointment::where('campus', $category)
            ->whereIn('appstatus', ['REJECTED', 'DELETED'])
            ->delete();

        return redirect()->back()->with('message', 'All rejected and deleted appointments have been removed.');
    }
}

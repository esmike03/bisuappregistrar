<?php

namespace App\Http\Controllers;

use App\Models\Holiday;
use App\Models\Message;
use App\Mail\RejectMail;
use App\Mail\ApprovedMail;
use App\Models\Appointment;
use Illuminate\Http\Request;
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

        return view('admin.dashboard', ['appointments' => $appointments, 'appointmentCount' => $appointmentCount, 'messages' => $messages,]);
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
    public function completed()
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

        return view('admin.partials.completed', ['appointments' => $appointments, 'appointmentCount' => $appointmentCount]);
    }

    //archive page
    public function archive()
    {
        if (!auth()->guard('admin')->check()) {
            // Redirect to the login page if not authenticated
            return redirect('/admin')->with('message', 'Please log in to access this page.');
        }
        $category = auth()->guard('admin')->user()->campus; // Get the category for the current admin

        $appointmentCount = Appointment::where('campus', $category)
            ->where('appstatus', 'pending')
            ->count();

        // Paginate the appointments with filtering by category
        $appointments = Appointment::where('campus', $category)
            ->orderBy('created_at', 'desc')
            ->paginate(3); // Adjust the number of items per page as needed

        return view('admin.partials.archive', ['appointments' => $appointments, 'appointmentCount' => $appointmentCount]);
    }

    //approved page
    public function approved()
    {
        if (!auth()->guard('admin')->check()) {
            // Redirect to the login page if not authenticated
            return redirect('/admin')->with('message', 'Please log in to access this page.');
        }
        $category = auth()->guard('admin')->user()->campus; // Get the category for the current admin

        $appointmentCount = Appointment::where('campus', $category)
            ->where('appstatus', 'pending')
            ->count();

        // Paginate the appointments with filtering by category
        $appointments = Appointment::where('campus', $category)
            ->orderBy('created_at', 'desc')
            ->paginate(3); // Adjust the number of items per page as needed

        return view('admin.partials.approved', ['appointments' => $appointments, 'appointmentCount' => $appointmentCount]);
    }


    //Delete Table row/ appointments
    public function destroy($id)
    {

        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        return redirect('/admin/dashboard')->with('message', 'Appointment deleted successfully.');
    }

    //Approved Appointment
    public function updateStatus(Request $request, $id)
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

        // Check if appstatus is 'rejected' before sending the email
        if ($request->input('appstatus') === 'rejected') {
            // Send rejected email
            Mail::to($data['email'])->send(new RejectMail($data));
        } else if ($request->input('appstatus') === 'approved') {
            // Send approved email
            Mail::to($data['email'])->send(new ApprovedMail($data));
        }

        return redirect('/admin/dashboard')->with('message', 'Appointment status updated successfully.');
    }



    //Show Appointment
    public function show(Appointment $appointment, Request $request)
    {

        return view('admin.partials.show', [
            'appointment' => $appointment,
        ]);
    }
}

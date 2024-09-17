<?php

namespace App\Http\Controllers;

use App\Models\Holiday;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        // Paginate the filtered appointments
        $appointments = $query->orderBy('created_at', 'desc')->paginate(3); // Adjust the number of items per page as needed

        return view('admin.dashboard', ['appointments' => $appointments, 'appointmentCount' => $appointmentCount]);
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


    //completed
    public function completed()
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

        return view('admin.partials.completed', ['appointments' => $appointments, 'appointmentCount' => $appointmentCount]);
    }

    //archive
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
        $appointment = Appointment::findOrFail($id);

        $appointment->update([
            'appstatus' => $request->input('appstatus'),
        ]);

        return redirect('/admin/dashboard')->with('message', 'Appointment status updated successfully.');
    }
}

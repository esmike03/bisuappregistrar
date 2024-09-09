<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //
    //Home
    public function admin()
    {
        return view('admin.login.admin-index');
    }

    //Dashboard
    public function dashboard()
    {
        $category = auth()->guard('admin')->user()->campus; // Get the category for the current admin

        $appointmentCount = Appointment::where('campus', $category)
        ->where('appstatus', 'pending')
        ->count();

        // Paginate the appointments with filtering by category
        $appointments = Appointment::where('campus', $category)
            ->paginate(3); // Adjust the number of items per page as needed

        return view('admin.dashboard', ['appointments' => $appointments, 'appointmentCount' => $appointmentCount]);
    }


    //Authenticate admin
    public function authenticate(Request $request){

        $formFields = $request->validate([
            'campus' => 'required',
            'password' => 'required'
        ]);

        // Attempt to authenticate using the admin guard
        if(Auth::guard('admin')->attempt($formFields)){
            $request->session()->regenerate();
            return redirect('/admin/dashboard')->with('message', 'Logged In!');
        }

        return back()->with('message', 'Invalid credentials!')->onlyInput('campus');
    }

    //logout admin
    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin')->with('message', 'You have been logout!');
    }
}

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

        $appointments = Appointment::all();
        return view('admin.dashboard', ['appointments' => $appointments]);
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

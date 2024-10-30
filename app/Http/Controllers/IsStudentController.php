<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\IsStudentsImport;
use Maatwebsite\Excel\Facades\Excel;

class IsStudentController extends Controller
{
    //
    public function upload(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'file' => 'required|mimes:csv,xlsx,xls',
        ]);

        // Load and import the CSV data
        Excel::import(new IsStudentsImport, $request->file('file'));

        return redirect()->back()->with('success', 'Students uploaded successfully.');
    }
}

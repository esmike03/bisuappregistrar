<?php

namespace App\Http\Controllers;

use App\Models\Holiday;
use App\Models\Maximum;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    //
    public function getHolidays()
    {
        $holidays = Holiday::all();
        return response()->json($holidays);
    }

    public function date(Request $request)
    {
        // $campus = auth()->guard('admin')->user()->campus;

        // Validate the request data
        $request->validate([
            'holiday_date' => 'required',
            'name' => 'required',
        ]);

        // Save the data to the database without converting the date format
        Holiday::create([
            'holiday_date' => $request->input('holiday_date'),
            'name' => $request->input('name'),
            // 'campus' => $campus

        ]);

        return redirect('/records')->with('message', 'Date Set Successfully!');
    }

    public function max(Request $request)
    {
        // Validate the request data
        $request->validate([
            'campus' => 'required', // Ensure 'campus' is also validated
            'change' => 'required|numeric', // Ensure 'change' is numeric if it's a number
        ]);

        // Find the maximum record for the given campus
        $maximum = Maximum::where('campus', $request->input('campus'))->first();

        if ($maximum) {
            // Update the 'num' field with the new value
            $maximum->num = $request->input('change');
            $maximum->save();
        } else {
            // Handle the case where the campus does not exist
            return redirect('/settings')->with('error', 'Campus not found!');
        }

        return redirect('/admin/settings')->with('message', 'Set Successfully!');
    }


    //Delete Table row/ appointments
    public function destroy($id)
    {

        $holidays = Holiday::findOrFail($id);
        $holidays->delete();

        return redirect('/records')->with('message', 'Date deleted successfully.');
    }
}

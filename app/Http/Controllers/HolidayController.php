<?php

namespace App\Http\Controllers;

use App\Models\Holiday;
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
        // Validate the request data
        $request->validate([
            'holiday_date' => 'required',
            'name' => 'required',
        ]);

        // Save the data to the database without converting the date format
        Holiday::create([
            'holiday_date' => $request->input('holiday_date'),
            'name' => $request->input('name'),
        ]);

        return redirect('/records')->with('message', 'Date Set Successfully!');
    }

    //Delete Table row/ appointments
    public function destroy($id)
    {

        $holidays = Holiday::findOrFail($id);
        $holidays->delete();

        return redirect('/records')->with('message', 'Date deleted successfully.');
    }
}

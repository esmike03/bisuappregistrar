<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\CompletedAppointment;

class AppointmentController extends Controller
{
    public function markAsCompleted($id)
    {
        try {
            // Find the appointment by ID
            $appointment = Appointment::findOrFail($id);

            // Move data to the completed table
            CompletedAppointment::create([
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
                'appstatus' => 'COMPLETED', // Set the correct status
                'request' => $appointment->request,
         // Properly formatted date
                'tracking_code' => $appointment->tracking_code,
            ]);

            // Optionally delete the original appointment
            $appointment->delete();

            return response()->json(['message' => 'Appointment marked as completed'], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Log or return detailed error message

            return response()->json(['message' => 'Appointment not found', 'error' => $e->getMessage()], 404);
        } catch (\Exception $e) {
            // Log or return detailed error message

            return response()->json([
                'message' => 'Failed to mark appointment as completed',
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(), // Optional: include stack trace for debugging
            ], 500);
        }
    }
}

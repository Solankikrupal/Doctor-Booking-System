<?php

namespace App\Http\Controllers\doctor;

use App\Http\Controllers\Controller;
use App\Http\Resources\AppointmentCollection;
use App\Jobs\LogMessage;
use App\Jobs\SendAppointmentConfirmationEmail;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class DoctorController extends Controller
{
    public function index(Request $request)
    {
        try {
            $doctorAppointments = Appointment::where('doctor_id', auth()->user()->id);

            // Filter by date if a date parameter is provided in the request
            if ($request->has('date')) {
                $doctorAppointments->where('appointment_time', $request->input('date'));
            }

            $appointments = $doctorAppointments->get();

            return response()->json(['data' => new AppointmentCollection($appointments)], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'status' => 'required|in:rsvp,approved,rejected,canceled,postpone',
            ]);

            if ($validator->fails()) {
                //throw an error required input is empty
                throw new ValidationException($validator, response()->json([
                    'message' => $validator->errors(),
                ], 422));
            }

            $appointment = Appointment::findOrFail($id);

            // Update appointment status
            $appointment->status = $request->status;
            $appointment->save();
            dispatch(new LogMessage('Doctor Portal status for ' . $appointment->patient_id . ' is ' . $appointment->status));

            return response()->json(['message' => 'Appointment status updated successfully', 'data' => new AppointmentCollection([$appointment])], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}

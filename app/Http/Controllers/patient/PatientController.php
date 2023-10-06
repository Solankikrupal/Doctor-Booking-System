<?php

namespace App\Http\Controllers\patient;

use App\Http\Controllers\Controller;
use App\Http\Resources\AppointmentCollection;
use App\Jobs\LogMessage;
use App\Jobs\SendAppointmentConfirmationEmail;
use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        try {
            $patientAppointments = Appointment::where('patient_id', auth()->user()->id);

            // Filter by date if a date parameter is provided in the request
            if ($request->has('date')) {
                $patientAppointments->where('appointment_time', $request->input('date'));
            }

            $appointments = $patientAppointments->get();

            return response()->json(['data' => new AppointmentCollection($appointments)], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            // Validate input
            $validator = Validator::make($request->all(), [
                'patient_id' => 'required|exists:users,id',
                'doctor_id' => 'required|exists:users,id',
                'appointment_time' => 'required',
            ]);

            if ($validator->fails()) {
                //throw an error required input is empty
                throw new ValidationException($validator, response()->json([
                    'message' => $validator->errors(),
                ], 422));
            }

            $existingAppointment = Appointment::where('doctor_id', $request->doctor_id)
                ->where('appointment_time', $request->appointment_time)
                ->where('status', '!=', 'canceled')
                ->first();

            if ($existingAppointment) {
                return response()->json(['error' => 'Appointment slot is already taken.'], 422);
            }

            // Create RSVP appointment
            $appointment = new Appointment();
            $appointment->patient_id = $request->patient_id;
            $appointment->doctor_id = $request->doctor_id;
            $appointment->appointment_time = Carbon::parse($request->appointment_time);
            $appointment->status = 'rsvp'; // RSVP until doctor approves
            $appointment->save();

            dispatch(new LogMessage('Patient Portal status for ' . $appointment->patient_id . ' is ' . $appointment->status));

            return response()->json(['message' => 'Appointment request created successfully.', 'data' => new AppointmentCollection([$appointment])], 201);
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

            return response()->json(['message' => 'Appointment status updated successfully', 'data' => $appointment], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}

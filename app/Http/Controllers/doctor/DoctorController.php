<?php

namespace App\Http\Controllers\doctor;

use App\Http\Controllers\Controller;
use App\Http\Resources\AppointmentCollection;
use App\Jobs\LogMessage;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class DoctorController extends Controller
{
    private $appointment;

    public function __construct()
    {
        $this->appointment = new Appointment;
    }

    /**
     * Get doctor's appointments based on the provided date.
     */
    public function index(Request $request)
    {
        try {
            $doctorId = auth()->user()->id;
            $date = $request->input('date');
            $appointments = $this->appointment->getDoctorAppointments($doctorId, $date);

            return response()->json(['data' => new AppointmentCollection($appointments)], 200);
        } catch (\Throwable $th) {
            // Handle and return error response for any exceptions
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    /**
     * Update the status of a doctor's appointment.
     */
    public function updateStatus(Request $request, $id)
    {
        try {
            // Validate input status
            $validator = Validator::make($request->all(), [
                'status' => 'required|in:rsvp,approved,rejected,canceled',
            ]);

            // Check if validation fails
            if ($validator->fails()) {
                // Return validation error response
                throw new ValidationException($validator, response()->json([
                    'message' => $validator->errors(),
                ], 422));
            }

            // Find the appointment by doctor ID and appointment ID
            $appointment = $this->appointment->findDoctorAppointmentById(auth()->user()->id, $id);

            // If appointment not found, return error response
            if (!$appointment) {
                return response()->json(['message' => 'Appointment is not available'], 422);
            }

            // Update appointment status
            $updateStatus = ['status' => $request->status];
            $this->appointment->updateStatus($id, $updateStatus);

            // Log the doctor portal status
            dispatch(new LogMessage('Doctor Portal status for ' . $appointment->patient_id . ' is ' . $appointment->status));

            // Return success response with updated appointment data
            return response()->json(['message' => 'Appointment status updated successfully', 'data' => new AppointmentCollection([$this->appointment->getAppointmentById($id)])], 200);
        } catch (\Throwable $th) {
            // Handle and return error response for any exceptions
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}

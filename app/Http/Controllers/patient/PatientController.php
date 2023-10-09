<?php

namespace App\Http\Controllers\patient;

use App\Http\Controllers\Controller;
use App\Http\Resources\AppointmentCollection;
use App\Jobs\LogMessage;
use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class PatientController extends Controller
{
    private $appointment;

    public function __construct()
    {
        $this->appointment = new Appointment;
    }

    /**
     * Get patient's appointments based on the provided date.
     */
    public function index(Request $request)
    {
        try {
            // Get patient ID and date from the request
            $patientId = auth()->user()->id;
            $date = $request->input('date');

            // Retrieve patient's appointments for the given date
            $appointments = $this->appointment->getPatientAppointments($patientId, $date);

            // Return appointments as a JSON response
            return response()->json(['data' => new AppointmentCollection($appointments)], 200);
        } catch (\Throwable $th) {
            // Handle and return error response for any exceptions
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    /**
     * Store a new appointment request for the patient.
     */
    public function store(Request $request)
    {
        try {
            // Validate input data
            $validator = Validator::make($request->all(), [
                'doctor_id' => 'required|exists:users,id',
                'appointment_time' => 'required|date_format:Y-m-d H:i|after_or_equal:now',
            ]);

            // Check if validation fails
            if ($validator->fails()) {
                // Return validation error response
                return response()->json(['message' => $validator->errors()], 422);
            }

            // Check if the appointment slot is available
            $existingAppointment = $this->appointment->checkExistingAppointment($request->doctor_id, $request->appointment_time);

            // If the slot is taken, return an error response
            if ($existingAppointment) {
                return response()->json(['error' => 'Appointment slot is already taken.'], 422);
            }

            // Prepare appointment details
            $appointmentDetail = [
                'patient_id' => auth()->user()->id,
                'doctor_id' => $request->doctor_id,
                'appointment_time' => Carbon::parse($request->appointment_time),
                'status' => 'rsvp'
            ];

            // Create a new appointment
            $createdAppointment = $this->appointment->createAppointment($appointmentDetail);

            // Return success response with the created appointment data
            return response()->json(['message' => 'Appointment request created successfully.', 'data' => new AppointmentCollection([$createdAppointment])], 201);
        } catch (\Throwable $th) {
            // Handle and return error response for any exceptions
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    /**
     * Update the status of a patient's appointment.
     */
    public function updateStatus(Request $request, $id)
    {
        try {
            // Validate input status
            $validator = Validator::make($request->all(), [
                'status' => 'required|in:rsvp,rejected,canceled,postpone',
            ]);

            // Check if validation fails
            if ($validator->fails()) {
                // Return validation error response
                return response()->json(['message' => $validator->errors()], 422);
            }

            // Find the appointment by ID and patient ID
            $appointment = $this->appointment->findAppointmentByIdAndPatientId($id, auth()->user()->id);

            // If appointment not found, return error response
            if (!$appointment) {
                return response()->json(['message' => 'Appointment is not available'], 422);
            }

            // Update appointment status
            $updateStatus = ['status' => $request->status];
            $this->appointment->updateStatus($id, $updateStatus);

            // Log the patient portal status
            dispatch(new LogMessage('Patient Portal status for ' . $appointment->patient_id . ' is ' . $appointment->status));

            // Return success response with updated appointment data
            return response()->json(['message' => 'Appointment status updated successfully', 'data' => $this->appointment->getAppointmentById($id)], 200);
        } catch (\Throwable $th) {
            // Handle and return error response for any exceptions
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}

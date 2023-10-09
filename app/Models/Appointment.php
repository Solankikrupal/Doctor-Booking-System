<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get all appointments.
     */
    public function getAllAppointments()
    {
        return Appointment::all();
    }

    /**
     * Create a new appointment.
     */
    public function createAppointment($appointmentDetails)
    {
        return Appointment::create($appointmentDetails);
    }

    /**
     * Update the status of an appointment.
     */
    public function updateStatus($appointmentId, $status)
    {
        return Appointment::whereId($appointmentId)->update($status);
    }

    /**
     * Get an appointment by ID.
     */
    public function getAppointmentById($id)
    {
        return Appointment::findOrFail($id);
    }

    /**
     * Get patient's appointments based on the provided patient ID and optional date.
     */
    public function getPatientAppointments($patientId, $date = null)
    {
        $patientAppointments = Appointment::where('patient_id', $patientId);

        // Filter by date if provided
        if ($date) {
            $date = Carbon::parse($date)->startOfDay();
            $patientAppointments->where('appointment_time', '>=', $date);
        }

        return $patientAppointments->get();
    }

    /**
     * Get doctor's appointments based on the provided doctor ID and optional date.
     */
    public function getDoctorAppointments($doctorId, $date = null)
    {
        $doctorAppointments = Appointment::where('doctor_id', $doctorId);

        // Filter by date if provided
        if ($date) {
            $date = Carbon::parse($date)->startOfDay();
            $doctorAppointments->where('appointment_time', '>=', $date);
        }

        return $doctorAppointments->get();
    }

    /**
     * Check if an appointment already exists for the provided doctor and time.
     */
    public function checkExistingAppointment($doctorId, $appointmentTime)
    {
        return Appointment::where('doctor_id', $doctorId)
            ->where('appointment_time', $appointmentTime)
            ->where('status', '!=', 'canceled')
            ->first();
    }

    /**
     * Find an appointment by ID and patient ID.
     */
    public function findAppointmentByIdAndPatientId($id, $patientId)
    {
        return Appointment::where('id', $id)
            ->where('patient_id', $patientId)
            ->first();
    }

    /**
     * Find a doctor's appointment by doctor ID and appointment ID.
     */
    public function findDoctorAppointmentById($doctorId, $id)
    {
        return Appointment::where('doctor_id', $doctorId)
            ->where('id', $id)
            ->first();
    }
}

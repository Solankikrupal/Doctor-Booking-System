Doctor Booking System 

API Documentation
Authentication

    Endpoint: /api/authenticate
    Method: POST
    Description: Authenticates a user (either patient or doctor) and provides an access token for further API requests.
    Request Body:

    json

{
  "email": "user@example.com",
  "password": "secret"
}

Response:

json

    {
      "message": "Login successful",
      "token": "access_token_here"
    }

Appointments
Create Appointment

    Endpoint: /api/appointments
    Method: POST
    Description: Allows patients to book appointments with doctors.
    Request Body:

    json

{
  "patient_id": 1,
  "doctor_id": 2,
  "appointment_time": "2023-11-01T10:00:00"
}

Response:

json

    {
      "message": "Appointment request created successfully"
    }

Update Appointment Status

    Endpoint: /api/appointments/{id}/update-status
    Method: PATCH
    Description: Allows patients to cancel/reject/postpone their appointments or doctors to approve/reject appointments.
    Request Body:

    json

{
  "status": "canceled"
}

Response:

json

    {
      "message": "Appointment status updated successfully"
    }

View Appointments

    Endpoint: /api/appointments
    Method: GET
    Description: Allows patients and doctors to view their respective appointments.
    Query Parameters:
        user_id (optional): ID of the patient or doctor to filter appointments.
        status (optional): Filter appointments by status (rsvp, approved, canceled, etc.).
    Response:

    json

{
  "appointments": [
    {
      "id": 1,
      "patient_id": 1,
      "doctor_id": 2,
      "appointment_time": "2023-11-01T10:00:00",
      "status": "rsvp"
    },
    {
      "id": 2,
      "patient_id": 3,
      "doctor_id": 2,
      "appointment_time": "2023-11-03T14:30:00",
      "status": "approved"
    }
  ]
}

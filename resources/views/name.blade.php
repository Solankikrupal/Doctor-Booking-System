<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Confirmation</title>
</head>
<body>
    <h1>Appointment Confirmation</h1>
    <p>Dear {{ $appointment->patient_id }},</p>
    <p>Your appointment with Dr. {{ $appointment->doctor_id }} has been confirmed.</p>
    <p>Appointment Date: {{ $appointment->appointment_time }}</p>
    <!-- Additional appointment details as needed -->
</body>
</html>

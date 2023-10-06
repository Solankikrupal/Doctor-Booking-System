Doctor Booking System

This Laravel-based web application facilitates the process of booking appointments between patients and doctors. Patients can request appointments, and doctors can approve, reject, or reschedule them.
Features

    Authentication: Users are authenticated with roles - patient and doctor.
    Appointment Management:
        Patients can create appointments, which are pending (RSVP) until the doctor approves.
        Appointments can be canceled, rejected, or postponed by both patients and doctors.
        Both patients and doctors can view their respective appointments.

Installation

Follow these steps to set up and run the Doctor Booking System locally:

    Clone this repository:

    sh

git clone https://github.com/your-username/doctor-booking-system.git

Navigate to the project directory:

sh

cd doctor-booking-system

Install dependencies using Composer:

sh

composer install

Copy the .env.example file to .env and configure your database and other settings.

Generate an application key:

sh

php artisan key:generate

Run migrations and seed the database:

sh

php artisan migrate --seed

Start the development server:

sh

    php artisan serve

    The application will be accessible at http://localhost:8000.

API Documentation

For detailed API documentation, please refer to the API Documentation file.
Folder Structure

    app/Http/Controllers: Contains the API controllers for handling requests.
    app/Models: Contains Eloquent models for the application entities.
    database/migrations: Contains database migration files.
    routes/api.php: Defines API routes and endpoints.
    tests: Contains PHPUnit test cases.

Technologies Used

    Laravel: A PHP web application framework for robust and maintainable code.
    Swagger/OpenAPI: Used for API documentation.

Contributing

Contributions are welcome! Here's how you can contribute to the project:

    Fork the repository.
    Create a new branch: git checkout -b feature/new-feature.
    Make your changes and commit them: git commit -m 'Add new feature'.
    Push to the branch: git push origin feature/new-feature.
    Submit a pull request.
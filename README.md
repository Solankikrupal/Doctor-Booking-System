# Doctor Booking System

Doctor Booking System is a web-based system that streamlines the scheduling and management of appointments between healthcare providers (doctors) and patients. This application offers a secure and efficient way for medical professionals and patients to coordinate their schedules, enhancing the overall healthcare experience.

## Features
***
* User Authentication: Users can register, log in, and receive authentication tokens securely.
* Role-Based Access Control: Role-specific permissions ensure proper access control for doctors and patients.
* Appointment Management:
    Patients: View existing appointments, create new appointment requests, and update appointment statuses.
    Doctors: View their appointments and manage appointment statuses based on availability and approval.
* Seamless Integration: Easily integrates into existing healthcare systems, enhancing patient care and scheduling efficiency.

## Technologies Used

Laravel: A robust PHP web framework that provides the foundation for this application.
Sanctum: Laravel's built-in API authentication package, ensuring secure token-based authentication.
Database: MySQL or any compatible database system is used for storing user and appointment data.
Database Seeder: Seeder scripts populate the database with initial data for testing and development.

## Installation

    Clone the repository to your local machine:

    bash

git clone <repository-url>.git

Install dependencies using Composer:

bash

composer install

Create a .env file by copying the .env.example file and updating the database configuration:

bash

cp .env.example .env

Update the following lines in the .env file:

env

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password

Generate an application key:

bash

php artisan key:generate

Run database migrations and seeders:

bash

php artisan migrate --seed

Start the development server:

bash

    php artisan serve

    The application will be accessible at http://localhost:8000.

API Documentation

For detailed information on available API endpoints and their usage, please refer to the API Documentation.

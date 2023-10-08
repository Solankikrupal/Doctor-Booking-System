# Doctor Booking System

Doctor Booking System is a web-based system that streamlines the scheduling and management of appointments between healthcare providers (doctors) and patients. This application offers a secure and efficient way for medical professionals and patients to coordinate their schedules, enhancing the overall healthcare experience.

## Features
***
* <b> User Authentication:</b> Users can register, log in, and receive authentication tokens securely.
* <b> Role-Based Access Control:</b> Role-specific permissions ensure proper access control for doctors and patients.
* <b> Appointment Management: </b>
    * <b> Patients: </b> View existing appointments, create new appointment requests, and update appointment statuses.
    * <b> Doctors: </b> View their appointments and manage appointment statuses based on availability and approval.
* <b> Seamless Integration: <b> Easily integrates into existing healthcare systems, enhancing patient care and scheduling efficiency.

## Technologies Used

*** 
* <b>Laravel:</b> A robust PHP web framework that provides the foundation for this application.
* <b>Sanctum:</b> Laravel's built-in API authentication package, ensuring secure token-based authentication.
* <b>Database:</b> MySQL or any compatible database system is used for storing user and appointment data.
* <b>Database Seeder:</b> Seeder scripts populate the database with initial data for testing and development.

## Installation
<ol>
    
<li>Clone the repository to your local machine:
    <br></br>
```
    git clone <repository-url>.git    
```

</li>
    
<li>Install dependencies using Composer:
    <br></br>
```
    composer install
```

</li>

<li>Create a .env file by copying the .env.example file and updating the database configuration:
    <br></br>
``` 
    cp .env.example .env
```

</li>

<li>Update the following lines in the .env file:
    <br></br>
```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_username
    DB_PASSWORD=your_database_password
```
</li>

<li>Generate an application key:
    <br></br>
```
    php artisan key:generate
```
    
</li>

<li>
Run database migrations and seeders:
    <br></br>
```
    php artisan migrate --seed
```
    
</li>

<li> Start the development server:
    <br></br>
```
    php artisan serve
    The application will be accessible at http://localhost:8000
```
    
</li>

</ol>
API Documentation

For detailed information on available API endpoints and their usage, please refer to the API Documentation.

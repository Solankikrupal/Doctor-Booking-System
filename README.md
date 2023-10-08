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

##Database Schema

The application uses two main tables in the database: users and appointments. Here's the schema for each table:

### users Table

| Column        | Type          | Description                       |
| ---------------- |:-------------:| -------------------------------:  |
| id               | Integer (PK)  | Unique identifier for the user.   |
| name         	   | String	       | User's name.
| email	           | String	       | User's email address (unique).
| role	           | Enum	       | User's role (patient or doctor).
| password	       | String	       | Hashed password for user security.
| email_verified_at | Timestamp	   | Timestamp indicating email verification status.
| remember_token	   | String	       | Laravel remember token for secure authentication.
| created_at	       | Timestamp	   | Timestamp indicating user creation time.
| updated_at	       | Timestamp	   | Timestamp indicating last update time.

### appointments Table

| Column        | Type          | Description                       |
| ---------------- |:-------------:| -------------------------------:  |
| id               | Integer (PK)  | Unique identifier for the user.   |
| patient_id	    |Integer (FK)	|User ID of the patient associated with the appointment.
| doctor_id	    |Integer (FK)	|User ID of the doctor associated with the appointment.
| appointment_time	|DateTime	|Date and time of the appointment.
| status	|Enum	|Status of the appointment (rsvp, approved, rejected, canceled, or postpone).
| created_at	|Timestamp	|Timestamp indicating appointment creation time.
| updated_at	|Timestamp	|Timestamp indicating last appointment update time.

### Entity Relationships

<ul>
    <li>
            Each appointment is associated with a patient and a doctor through the patient_id and doctor_id foreign keys in the appointments table.
    </li>
    <li>
        The users table's id column is used as a foreign key in the appointments table to establish these relationships.
    </li>
</ul>

## Installation
<ol>
    
<li>Clone the repository to your local machine:
    
```
    git clone https://github.com/Solankikrupal/Doctor-Booking-System.git
```

</li>
    
<li>Install dependencies using Composer:
    
```
    composer install
```

</li>

<li>Create a .env file by copying the .env.example file and updating the database configuration:
    
``` 
    cp .env.example .env
```

</li>

<li>Update the following lines in the .env file:
    
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
    
```
    php artisan migrate --seed
```
    
</li>

<li> Start the development server:
    
```
    php artisan serve
    The application will be accessible at http://localhost:8000
```
    
</li>

</ol>
API Documentation

For detailed information on available API endpoints and their usage, please refer to the [API Documentation.](https://planetary-shuttle-18421.postman.co/workspace/New-Team-Workspace~ba89521a-dff0-42a0-9ac1-21c9a380d92e/collection/30305514-8b61207d-4d6c-4319-9e52-34eaa2600dbb?action=share&creator=30305514)

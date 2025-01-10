# Gym Management System

## Description

The **Gym Management System** is a robust platform that helps manage gym subscriptions, training sessions, equipment, attendance tracking, and meal plans. It includes distinct user roles—visitors, members, trainers, and admins—each with specific access and functionalities. Built with Laravel, the application is modular, scalable, and integrates various technologies for an optimized experience.

## Features

### User Roles & Functionalities

1. **Visitor**:
   - Sign up with full name, email, and password.
   - Log in.
   - Browse available sessions and gym services.

2. **Member**:
   - Log in.
   - Browse training sessions .
   - Book an appointment to attend a session.
   - Rate trainers or services.
   - Subscribe to meal plans.
   - Subscribe to membership packages.
   - Log attendance .
   - Email verification and password reset features. .

3. **Trainer**:
   - Manage training sessions (accept members, update session status).
   - Monitor member attendance and organize schedule.
   - Track attendance and log absences.

4. **Admin**:
   - Manage training sessions (view, add, edit, delete sessions).
   - Manage gym equipment (view, add, edit, delete equipment).
   - Manage trainers and employees (view, add, edit, delete).
   - Manage membership requests and member booking appointments.
   - Track member attendance.
   - Manage subscription packages.

### Advanced Features

   - **Permission System**: Role-based permissions using Spatie Laravel Permission to   restrict access and ensure secure data management.
   - **Blade Dashboard**: A simple and organized dashboard for admins to manage   various     aspects of the gym. 
   - **Smart Appointment System**:
   - Members can book specific slots to attend gym sessions or use equipment.
   - The system prevents double-booking and ensures optimal distribution of gym space. 
   - **Services**:
     The system utilizes a Services folder to encapsulate key business logic, such as handling filtering, session management, and more. Services help keep the codebase clean, maintainable, and modular. 
   - **Smart Appointment System**: 



## Installation Guide

To run this project locally, follow the steps below:

### Prerequisites
- PHP 8.2 or higher
- Composer
- Laravel 10.x
- MySQL or compatible database

### Steps

1. **Clone the repository**:

   ```bash
   git clone https://github.com/monirkrori/gym-system-final.git
   cd gym-system-final
   ```

2. **Install dependencies**:

   Run the following command to install the required dependencies via Composer:

   ```bash
   composer install
   ```

3. **Set up environment file**:

   Copy the example `.env` file to create your own `.env`:

   ```bash
   cp .env.example .env
   ```

4. **Generate the application key**:

   ```bash
   php artisan key:generate
   ```

5. **Set up the database**:

   - Create a new database in MySQL or your preferred database system.
   - Configure the `.env` file with the database connection details.

6. **Run migrations**:

   Run the migrations to set up the database tables:

   ```bash
   php artisan migrate
   ```

7. **Seed the database**:

    run the database seeder:

   ```bash
   php artisan db:seed
   ```

8. **Serve the application**:

   Start the  server:

   ```bash
   php artisan serve
   ```

   You can now access the system at `http://localhost:8000`.

## Postman Collection

For API testing, you can see the Postman collection :

[https://www.postman.com/research-geoscientist-78470583/workspace/my-workspace/collection/39063412-72cd18ef-1928-4769-9ece-086a621fcb39?action=share&creator=39063412](#)



## Technologies Used

- **Laravel 10.x**: PHP framework for web development.
- **Blade**: Templating engine used for building the admin dashboard.
- **Spatie Laravel Permission**: For handling user roles and permissions.
- **Livewire**: For building dynamic interfaces.
- **Dompdf**: For generating PDF reports (exporting trainer,member schedules).
- **Pusher**: For real-time communication (notifications).
- **maatwebsite/excel**: For handling Excel files (exporting trainer,member data).
- **Laravel Sanctum**: For API authentication.
- **Servicse**: Modular, reusable logic for handling operations.


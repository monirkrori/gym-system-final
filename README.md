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

## ErdDigram 

For ERD Digram, you can see the Erd Digram :

[https://mermaid.live/edit#pako:eNq1V9tu2zAM_RXDz-0P5HnYyzBgwN6GAAIj0bYQXTxd0mZt_n2Ur_EtLdrUD4alQ8okD0lJLzm3AvNdju6bhNKB3puMnujR-ez19fHRvmTBgTRpvMsq8CsCacA06gPNVbLeFoQQ0AgwHJmy5bacgyBNg3OHEHBN5mDtsRPScFwVMTbIQnJazJok55CjPPWi7Xtw7tpZWpd59L7T49aIyMNEb3SX1QrMrVhIw1UU_W-vFYEfocS76K7ZbYuCpMfATNZu9F5pSVCdB7ussErZJ9JYRGiy8ttsbupcsTYIt--e84udpQDJMYe1kjgY1rL80g7Sc5ClNCGTIvv1Y5z1wdEamQGNi0nUINU4G6RGH0DXLcBO6Ch1UDAIC9W6sgaZiSmWS9DZQipkJBTsiCKJZyWFa00FvH-yTrTApXdyyMw3_exmG4oJ-r4Mga-RS1DyX1MLI0xqWKLL8LkmhzFReUbocyY9hbIQOjYYnMqZSxSzEP3M8kVtfIwpQTZrUBRSyXFps4iu8YZpa0J1RSU-B9L13Ml66u37LO4L60uM1vDMFsXxOdsXlf2ZfOmgRNsW1MZnAx3ayRwX1MaT_S6w9DkDqDBm033AXKrHjWhtxwT_RllrJIM-1STCucYbv9tmbFrEk0b4XnZux7lrDhvlPnXmjaRacVLIgvbNqMKZKTyhmrKVemVHZfpcAROdU6ink0fniBbGgfyT4bxeIUt0m-r5LnSH7J-TtpbLjZ-8Qn5k0mxCNob35A8dVHDuV78B3sEfWgrhoFIuLVJlwKZp0Lex1oqZudzqVFsrKdtwOzPiVtcdzh4fK9PtzB7yDZSljc0z2t-ow5xvNurBsOGUcofgb-TQejIMp5BkwdXpY7BseqS9w8lgNXpX7Y9tNkbGLcV2edRofFpX67ArxUv-kGt01OMF3UIaf_Z5qJCU8x19CnDHfb43SQ5isL_Phue74CI-5M7Gssp3BShPo1in2utuMcNsDeaPteMYhQzW_WwvPc3d5_If_gkq6g](#)

## Technologies Used

- **Laravel 10.x**: PHP framework for web development.
- **Blade**: Templating engine used for building the admin dashboard.
- **Spatie Laravel Permission**: For handling user roles and permissions.
- **Dompdf**: For generating PDF reports (exporting trainer,member schedules).
- **Pusher**: For real-time communication (notifications).
- **maatwebsite/excel**: For handling Excel files (exporting trainer,member data).
- **Laravel Sanctum**: For API authentication.
- **Servicse**: Modular, reusable logic for handling operations.


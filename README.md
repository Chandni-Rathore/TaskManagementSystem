# Task Management System
Introduction:
This is a simple task management system built using Laravel. It allows users to manage tasks by providing basic CRUD (Create, Read, Update, Delete, Search) functionality. The system incorporates Laravel migrations, server-side validation, Faker for seed data generation, and Artisan commands for various operations.

Features:<br>
->Task CRUD Operations: Easily create, read, update, delete and search tasks.<br>
->Pagination: To manage a large number of records.<br>
->Migrations: Database schema is managed using Laravel migrations for easy setup and version control.<br>
->Server-Side Validation: All incoming requests are validated on the server to ensure data integrity.<br>
->Faker Seeder: Seed the database with realistic sample data using Faker for testing and development.<br>
->Artisan Commands: Utilize Artisan commands for streamlined operations.

Requirements:<br>
PHP 7.3 or higher<br>
Composer<br>
Laravel 8 or higher<br>

Steps to meet the requirement:<br>

->clone the remote repo to local:
<br>
git clone https://github.com/Chandni-Rathore/TaskManagementSystem.git
<br>
->composer install
<br>
->Update the database configuration in the .env file.
<br>
->Run migration:
<br>
php artisan migrate
<br>
->Seed the database:
<br>
php artisan db:seed
<br>
->Serve the application:
<br>
php artisan serve
<br>
->Visit http://localhost:8000/taskList or http://127.0.0.1:8000/taskList in your browser.
<br>
Usage:
<br>
->Navigate to the tasks section to manage your tasks.
<br>
->Create, update, delete and search tasks as needed.
<br>
Acknowledgments:
<br>
Laravel Documentation: https://laravel.com/docs
<br>

Author:
<br>
Chandni Rathore

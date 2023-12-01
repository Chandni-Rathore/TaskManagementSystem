# Task Management System
Introduction:
This is a simple task management system built using Laravel. It allows users to manage tasks by providing basic CRUD (Create, Read, Update, Delete, Search) functionality. The system incorporates Laravel migrations, server-side validation, Faker for seed data generation, and Artisan commands for various operations.

Features:
->Task CRUD Operations: Easily create, read, update, delete and search tasks.
->Pagination: To manage a large number of records.
->Migrations: Database schema is managed using Laravel migrations for easy setup and version control.
->Server-Side Validation: All incoming requests are validated on the server to ensure data integrity.
->Faker Seeder: Seed the database with realistic sample data using Faker for testing and development.
->Artisan Commands: Utilize Artisan commands for streamlined operations.

Requirements:
PHP 7.3 or higher
Composer
Laravel 8 or higher

Steps to meet the requirement:

->clone the remote repo to local:
git clone https://github.com/Chandni-Rathore/TaskManagementSystem.git

->composer install

->Update the database configuration in the .env file.

->Run migration:
php artisan migrate

->Seed the database:
php artisan db:seed

->Serve the application:
php artisan serve

->Visit http://localhost:8000/taskList or http://127.0.0.1:8000/taskList in your browser.

Usage:
->Navigate to the tasks section to manage your tasks.
->Create, update, delete and search tasks as needed.

Acknowledgments:
Laravel Documentation: https://laravel.com/docs


Author:
Chandni Rathore

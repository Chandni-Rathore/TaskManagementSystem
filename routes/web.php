<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


/****
 * 
 * Routes to perform CRUD operation
 * Used reverse routing for an operation.
 * 
 */

 Route::get('createView', function(){
    return view('createView');
});
Route::post('saveTask',[TaskController::class, 'saveTask'] );
Route::get('taskList',[TaskController::class, 'taskList'] );
Route::post('taskList',[TaskController::class, 'taskList'] );
Route::post('editTask',[TaskController::class, 'editTask'] );
Route::post('saveEditTask/{id}',[TaskController::class, 'saveEditTask'] )->name('saveEditTask');
Route::post('deleteTask',[TaskController::class, 'deleteTask'] )->name('deleteTask');
Route::post('completeTask',[TaskController::class, 'completeTask'] )->name('completeTask');


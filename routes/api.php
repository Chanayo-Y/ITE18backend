<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\EmployeeController;
// add other controllers as needed

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// PUBLIC ROUTES
Route::post('/login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']); // if you have register

// PROTECTED ROUTES (require login / token)
Route::middleware('auth:sanctum')->group(function () {

    // Students 
    Route::get('students', [StudentController::class, 'index']);       // list all students
    Route::get('students/{id}', [StudentController::class, 'show']);   // view a single student
    Route::post('students', [StudentController::class, 'store']);      // create student
    Route::put('students/{id}', [StudentController::class, 'update']); // update student
    Route::delete('students/{id}', [StudentController::class, 'destroy']); // delete student

    // Employees
    Route::get('employees', [EmployeeController::class, 'index']);
    Route::get('employees/{id}', [EmployeeController::class, 'show']);
    Route::post('employees', [EmployeeController::class, 'store']);
    Route::put('employees/{id}', [EmployeeController::class, 'update']);
    Route::delete('employees/{id}', [EmployeeController::class, 'destroy']);

});

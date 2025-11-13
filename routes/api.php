<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AttendanceController;
use Illuminate\Support\Facades\Route;

Route::post('auth/register', [AuthController::class, 'register']);
Route::post('auth/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::post('auth/logout', [AuthController::class,'logout']);
    Route::get('auth/me', [AuthController::class,'me']);

    // Students CRUD
    Route::apiResource('students', StudentController::class);

    // Attendances: index, show, create, update, delete
    Route::apiResource('attendances', AttendanceController::class);
});

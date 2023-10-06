<?php

use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\doctor\DoctorController;
use App\Http\Controllers\patient\PatientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'store']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Doctor Routes
    Route::prefix('doctor')->group(function () {
        Route::group(['middleware' => 'checkrole:doctor'], function () {
            Route::get('appointment', [DoctorController::class, 'index']);
            Route::post('appointment/{id}/update-status', [DoctorController::class, 'updateStatus']);
        });
    });

    // Patient Routes
    Route::prefix('patient')->group(function () {
        Route::group(['middleware' => 'checkrole:patient'], function () {
            Route::get('appointment', [PatientController::class, 'index']);
            Route::post('appointment/create-appointment', [PatientController::class, 'store']);
            Route::post('appointment/{id}/update-status', [PatientController::class, 'updateStatus']);
            // Add more patient routes as needed
        });
    });
    
});

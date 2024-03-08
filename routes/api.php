<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ResidentController;
use App\Http\Controllers\Api\CertificateController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and assigned to the "api"
| middleware group. Enjoy building your API!
|
*/

// Authentication Routes
Route::post('login', [AuthController::class, 'login'])->name('user.login');
Route::post('register', [UserController::class, 'register'])->name('user.register');

Route::get('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::put('/users/password/{id}', [UserController::class, 'updatePassword'])->name('user.password.update')->middleware('auth:sanctum');
Route::put('/users/email/{id}', [UserController::class, 'updateEmail'])->name('user.email.update')->middleware('auth:sanctum');
Route::put('/users/image/{id}', [UserController::class, 'updateImage'])->name('user.image.update')->middleware('auth:sanctum');



// Certificate Routes
Route::prefix('certificates')->group(function () {
    Route::get('/', [CertificateController::class, 'index']);
    Route::post('/', [CertificateController::class, 'store']);
    Route::get('/{certificate}', [CertificateController::class, 'show']);
    Route::put('/{certificate}', [CertificateController::class, 'update']);
    Route::delete('/{certificate}', [CertificateController::class, 'destroy']);
});

// Resident Routes
Route::prefix('residents')->group(function () {
    Route::get('/', [ResidentController::class, 'index']);
    Route::post('/', [ResidentController::class, 'store']);
    Route::get('/{resident}', [ResidentController::class, 'show']);
    Route::put('/{resident}', [ResidentController::class, 'update']);
    Route::delete('/{resident}', [ResidentController::class, 'destroy']);
});

Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index']); 
    Route::post('/', [UserController::class, 'store']); 
    Route::get('/{id}', [UserController::class, 'show']); 
    Route::put('/{id}', [UserController::class, 'update']); 
    Route::delete('/{id}', [UserController::class, 'destroy']); 
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AppointmentController;

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

Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [UserController::class, 'processRegistration']);

Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    // Route::get('/photo-album', [PhotoController::class, 'index']);
    //Route::get('/photo-album', [AppointmentController::class, 'index']);
    // Route::post('/photo/upload', [PhotoController::class, 'upload'])->name('photo.upload');
    //Route::post('/photo/email', [PhotoController::class, 'sendEmail'])->name('photo.email');
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::get('/appointments/{id}/edit', [AppointmentController::class, 'edit'])->name('appointments.edit');
    Route::put('/appointments/{id}', [AppointmentController::class, 'update'])->name('appointments.update');
    Route::delete('/appointments/{id}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');
});


<?php

use App\Mail\Email;
use App\Models\Appointment;
use App\Http\Controllers\Verify;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\MessageController;


//User
//Home
Route::get('/', [HomeController::class, 'index']);

//Appointment Form
Route::get('/appointment/form', [HomeController::class, 'form']);

Route::get('/search', [HomeController::class, 'search'])->name('appointment.search');


//Submit Appointment
Route::post('/appointment', [HomeController::class, 'store']);

//Edit Appointment
Route::get('/appointment/{code}/edit', [HomeController::class, 'edit']);

//Update Appointment
Route::put('/appointment/{code}', [HomeController::class, 'update']);

//Admin
Route::get('/admin', [AdminController::class, 'admin']);

//Dashboard
Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);


//login admin
Route::get('/admin/authenticate', [AdminController::class, 'authenticate'] );

//Logout admin
Route::post('/logout', [AdminController::class, 'logout']);

//To records
Route::get('/records', [AdminController::class, 'records']);

//To completed
Route::get('/completed', [AdminController::class, 'completed']);

//To archive
Route::get('/archive', [AdminController::class, 'archive']);

//To approved appointments
Route::get('/approved', [AdminController::class, 'approved']);

//To delete data
Route::delete('/appointments/{id}', [AdminController::class, 'destroy'])->name('appointments.destroy');

//To Approve Appointmnet
Route::patch('/appointments/{id}/status', [AdminController::class, 'updateStatus'])->name('appointments.updateStatus');

//Calendar Holiday
Route::get('/holidays', [HolidayController::class, 'getHolidays']);

//Add Date
Route::post('/date', [HolidayController::class, 'date']);

//Delete Holiday
Route::delete('/holidays/{id}', [HolidayController::class, 'destroy'])->name('holidays.destroy');

//Show Appointment
Route::get('/appointment/{appointment}', [AdminController::class, 'show']);

//Send Message to the user
Route::get('/email-user/{email}/{subject}/{message}', [MessageController::class, 'emailUser'])->name('email-user');
Route::post('/send-emailuser', [MessageController::class, 'sendEmailUser'])->name('send.emailuser');

//Send Message
Route::post('/message', [MessageController::class, 'message']);

//Send Email
Route::get('/send-email', [EmailController::class, 'sendEmail']);

//Verify
Route::get('/verify', [Verify::class, 'verify']);
Route::get('/send-email', [Verify::class, 'sendemail']);

//send code and verify
Route::post('/send-verification', [Verify::class, 'sendVerificationCode'])->name('send.verification');
Route::post('/verify-code', [Verify::class, 'verifyCode'])->name('verify.code');

//Delete Messages
Route::delete('/messages/{id}', [MessageController::class, 'destroy'])->name('messages.destroy');

<?php

use App\Models\Appointment;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

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

//To delete data
Route::delete('/appointments/{id}', [AdminController::class, 'destroy'])->name('appointments.destroy');

//To Approve Appointmnet
Route::patch('/appointments/{id}/status', [AdminController::class, 'updateStatus'])->name('appointments.updateStatus');


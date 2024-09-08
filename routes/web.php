<?php

use App\Models\Appointment;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

//Home
Route::get('/', [HomeController::class, 'index']);

//Admin
Route::get('/admin', [AdminController::class, 'admin']);

//Dashboard
Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);

//Appointment Form
Route::get('/appointment/form', [HomeController::class, 'form']);

Route::get('/search', [HomeController::class, 'search'])->name('appointment.search');

//Submit Appointment
Route::post('/appointment', [HomeController::class, 'store']);

//login admin
Route::get('/admin/authenticate', [AdminController::class, 'authenticate'] );

//Logout admin
Route::post('/logout', [AdminController::class, 'logout']);

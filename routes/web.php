<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


// Clinic User Authentication Routes
use App\Http\Controllers\Auth\ClinicUser\ClinicUserAuthController;

Route::get('/clinic/login', [ClinicUserAuthController::class, 'showLoginForm'])->name('clinic.login');
Route::post('/clinic/login', [ClinicUserAuthController::class, 'store'])->name('clinic.login.store');

//the exception middle ware issue like dashbaord shoud go back to login (boostrap/app.php)
use App\Http\Controllers\ClinicUser\DashboardController;
use App\Http\Controllers\ClinicUser\PatientsController;
use App\Http\Controllers\ClinicUser\ClinicUserProfileController;
use App\Http\Controllers\ClinicUser\ReportsController;

Route::middleware('auth:clinic_user')->group(function () {
    
    Route::get('/clinic/dashboard', [DashboardController::class, 'index'])
        ->name('clinic.dashboard');

    Route::post('/clinic/logout', function () {
        Auth::guard('clinic_user')->logout();
        return redirect()->route('clinic.login');
    })->name('clinic.logout');


    Route::get('/clinic/patients', [PatientsController::class, 'index'])
        ->name('clinic.patients');

    Route::get('/clinic/profile', [ClinicUserProfileController::class, 'index'])
        ->name('clinic.profile');

    Route::get('/clinic/reports', [ReportsController::class, 'index'])
        ->name('clinic.reports');


});
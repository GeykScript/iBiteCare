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


// Staff/Admin Auth (default)

// Patient Auth
use App\Http\Controllers\Auth\ClinicUser\ClinicUserAuthController;

Route::get('/clinic/login', [ClinicUserAuthController::class, 'showLoginForm'])->name('clinic.login');
Route::post('/clinic/login', [ClinicUserAuthController::class, 'store'])->name('clinic.login.store');

// Route::post('/clinic/login', [ClinicUserAuthController::class, 'login']);

Route::post('/clinic/logout', function () {
    Auth::guard('clinic_user')->logout();
    return redirect()->route('clinic.login'); // Redirect to your admin login view
})->name('clinic.logout');


Route::middleware('auth:clinic_user')->group(function () {
    Route::get('/clinic/dashboard', function () {
        return view('ClinicUser.dashboard');
    })->name('ClinicUser.dashboard'); // ✅ Add this
});

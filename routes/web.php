<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\PasswordSetupController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(SocialiteController::class)->group(function(){
    Route::get('auth/{provider}', 'redirect')->name('auth.provider');
    Route::get('auth/{provider}/callback', 'callback')->name('auth.provider-callback');
});


Route::get('/set-password', [PasswordSetupController::class, 'showForm'])->name('set.password');
Route::post('/set-password', [PasswordSetupController::class, 'store'])->name('set.password.store');


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
use App\Http\Controllers\Auth\ClinicUser\PasswordController;
use App\Http\Controllers\ClinicUser\TwoFactorAuthenticationController;
use App\Http\Controllers\ClinicUser\ForgotPasswordController;
use App\Http\Controllers\ClinicUser\UpdatePasswordController;
use App\Http\Controllers\ClinicUser\ClinicUsersController;
use App\Http\Controllers\PatientTwoFactorAuthenticationController;
use App\Http\Controllers\PatientForgotPasswordController;
use App\Http\Controllers\PatientUpdatePasswordController;
use App\Models\Patient;

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

    Route::put('/clinic/password', [PasswordController::class, 'update'])
        ->name('clinic.password.update');

    Route::get('/clinic/user-accounts', [ClinicUsersController::class, 'index'])
        ->name('clinic.user-accounts');
    // routes/web.php
    Route::get('/clinic-users/generate-id', [ClinicUsersController::class, 'generateId'])
        ->name('clinic-users.generateId');
    Route::post('/clinic-users/create', [ClinicUsersController::class, 'createUserAccount'])
        ->name('clinic.users.create');

        

}); 

Route::get('/clinic/two-factor/{id}', [TwoFactorAuthenticationController::class, 'index'])
    ->name('clinic.two-factor');

Route::post('/clinic/two-factor/send', [TwoFactorAuthenticationController::class, 'send_code'])
    ->name('clinic.two-factor.send_code');

Route::post('/clinic/two-factor/verify', [TwoFactorAuthenticationController::class, 'verify'])
    ->name('clinic.two-factor.verify');

Route::get('/clinic/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('clinic.forgot-password');


Route::get('/clinic/update-password/{id}', [UpdatePasswordController::class, 'updatePasswordForm'])
    ->name('clinic.update-password');
    
Route::post('/clinic/update-password', [UpdatePasswordController::class, 'updatePassword'])
    ->name('clinic.update-password.update');


// Patient Forgot Password

Route::get('/patient/two-factor/{id}', [PatientTwoFactorAuthenticationController::class, 'index'])
    ->name('patient.two-factor');

Route::post('/patient/two-factor/send', [PatientTwoFactorAuthenticationController::class, 'send_code'])
    ->name('patient.two-factor.send_code');

Route::post('/patient/two-factor/verify', [PatientTwoFactorAuthenticationController::class, 'verify'])
    ->name('patient.two-factor.verify');

Route::get('/patient/forgot-password', [PatientForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('patient.forgot-password');


Route::get('/patient/update-password/{id}', [PatientUpdatePasswordController::class, 'updatePasswordForm'])
    ->name('patient.update-password');
    
Route::post('/patient/update-password', [PatientUpdatePasswordController::class, 'updatePassword'])
    ->name('patient.update-password.update');




// Route::get('/preview-email', function () {
//     return new \App\Mail\TwofactorCodeMail(123456);
// });

// Route::get('/preview-clinic-user-account-email', function () {
//     $user_account = (object) [
//         'account_id' => 'DrCare-2023-0001-0001',
//         'email' => 'user@example.com'
//     ];
//     $user_default_password = 'DrCareABC-2023-0001-0001';

//     return new \App\Mail\ClinicUserAccountMail($user_account, $user_default_password);
// });
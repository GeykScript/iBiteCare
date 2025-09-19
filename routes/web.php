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
// Guest-only routes
Route::middleware('guest.clinic')->group(function () {
    Route::get('/clinic/login', [ClinicUserAuthController::class, 'showLoginForm'])
        ->name('clinic.login');
    Route::post('/clinic/login', [ClinicUserAuthController::class, 'store'])
        ->name('clinic.login.store');
}); 

//the exception middle ware issue like dashbaord shoud go back to login (boostrap/app.php)
use App\Http\Controllers\ClinicUser\DashboardController;
use App\Http\Controllers\ClinicUser\PatientsController;
use App\Http\Controllers\ClinicUser\PatientTransactionsController;
use App\Http\Controllers\ClinicUser\ClinicUserProfileController;
use App\Http\Controllers\ClinicUser\ReportsController;
use App\Http\Controllers\Auth\ClinicUser\PasswordController;
use App\Http\Controllers\ClinicUser\TwoFactorAuthenticationController;
use App\Http\Controllers\ClinicUser\ForgotPasswordController;
use App\Http\Controllers\ClinicUser\UpdatePasswordController;
use App\Http\Controllers\ClinicUser\ClinicUsersController;
use App\Http\Controllers\ClinicUser\InventorySupplies;
use App\Http\Controllers\ClinicUser\ManageInventorySupplies;
use App\Http\Controllers\ClinicUser\Services;
use App\Http\Controllers\ClinicUser\Payments;
use App\Http\Controllers\ClinicUser\Transactions;

Route::middleware('auth:clinic_user')->group(function () {
    
    Route::get('/clinic/dashboard', [DashboardController::class, 'index'])
        ->name('clinic.dashboard');

    Route::post('/clinic/logout', function () {
        Auth::guard('clinic_user')->logout();
        return redirect()->route('clinic.login');
    })->name('clinic.logout');


    Route::get('/clinic/patients', [PatientsController::class, 'index'])
        ->name('clinic.patients');

    Route::get('/clinic/patients/profile/{id}', [PatientsController::class, 'viewProfile'])
        ->name('clinic.patients.profile');

    Route::put('/clinic/patients/profile/update', [PatientsController::class, 'updateProfile'])
        ->name('clinic.patients.profile.update');

    Route::get('/clinic/patients/transactions/{id}', [PatientTransactionsController::class, 'index'])
        ->name('clinic.patients.transactions');
        

    Route::get('/clinic/reports', [ReportsController::class, 'index'])
        ->name('clinic.reports');


    //CLINIC USER PROFILES PAGES
    Route::get('/clinic/profile', [ClinicUserProfileController::class, 'index'])
        ->name('clinic.profile');

    Route::put('/clinic/profile/update', [ClinicUserProfileController::class, 'updateUserProfileAccount'])
        ->name('clinic.user-profile.update');

    Route::put('/clinic/password', [PasswordController::class, 'update'])
        ->name('clinic.password.update');
    //----------------END-----------------------//
        
    // CLINIC USER ACCOUNTS ---------------------------
    Route::post('/clinic-users/create', [ClinicUsersController::class, 'createUserAccount'])
        ->name('clinic.users.create');

    Route::get('/clinic-users/generate-id', [ClinicUsersController::class, 'generateId'])
        ->name('clinic-users.generateId');

    Route::get('/clinic/user-accounts', [ClinicUsersController::class, 'index'])
        ->name('clinic.user-accounts');
    
    Route::put('/clinic-users/update', [ClinicUsersController::class, 'updateClinicUserInfo'])
        ->name('clinic.users.update');

    Route::get('/clinic/user-logs', [ClinicUsersController::class, 'ClinicUserLogs'])
        ->name('clinic.user-logs');
    //-----------------END-----------------------//


    // CLINIC INVENTORY SUPPLIES ---------------------------
    Route::get('/clinic/supplies', [InventorySupplies::class, 'index'])
        ->name('clinic.supplies');

    Route::post('/clinic/supplies/add', [InventorySupplies::class, 'add_new_supplies'])
        ->name('clinic.supplies.add_new_supplies');

    Route::get('/clinic/supplies/Usage', [InventorySupplies::class, 'view_usage'])
        ->name('clinic.supplies.view_usage');


    Route::get('/clinic/supplies/manage/{id}', [ManageInventorySupplies::class, 'index'])
            ->name('clinic.supplies.manage');
    Route::post('/clinic/supplies/manage/add', [ManageInventorySupplies::class, 'add_new_stock'])
        ->name('clinic.supplies.manage.add');
    Route::put('/clinic/supplies/manage/edit', [ManageInventorySupplies::class, 'editProduct'])
        ->name('clinic.supplies.manage.edit');

    Route::put('/clinic/supplies/manage/edit/quantity', [ManageInventorySupplies::class, 'updateQuantity'])
        ->name('clinic.supplies.manage.edit.quantity');
    //-----------------END-----------------------//


    // CLINIC SERVICES ---------------------------
    Route::get('/clinic/services', [Services::class, 'index'])
        ->name('clinic.services');
        
    Route::get('/clinic/services/update/{id}', [Services::class, 'update'])
        ->name('clinic.services.update');
    
    Route::put('/clinic/services/update/details', [Services::class, 'updateServiceDetails'])
        ->name('clinic.services.update.details');
    
    Route::post('/clinic/services/add', [Services::class, 'addNewService'])
        ->name('clinic.services.add');
    
    //-----------------END-----------------------//

    // CLINIC PAYMENTS ---------------------------
    Route::get('/clinic/payments', [Payments::class, 'index'])
        ->name('clinic.payments');
    //-----------------END-----------------------//

    // CLINIC TRANSACTIONS ---------------------------
    Route::get('/clinic/transactions', [Transactions::class, 'index'])
        ->name('clinic.transactions');
    //-----------------END-----------------------//

}); 
//---------CLINIC LOGIN FORGOT PASSOWORD --------------------------
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


    //--------------------------END----------------------------------------------//




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
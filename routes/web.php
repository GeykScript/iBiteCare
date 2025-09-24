<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\PasswordSetupController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BookingController;
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

Route::prefix('book')->group(function () {
    Route::get('/', [BookingController::class, 'index'])->name('booking.index');
    Route::post('/', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/slots', [BookingController::class, 'getAvailableSlots'])->name('booking.slots');
    Route::post('/{id}/cancel', [BookingController::class, 'cancel'])->name('booking.cancel');
    Route::post('/{id}/reschedule', [BookingController::class, 'reschedule'])->name('booking.reschedule');
});

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

use App\Http\Controllers\ClinicUser\AddTransactions\CompleteImmunizations;
use App\Http\Controllers\ClinicUser\AddTransactions\PepTransaction;
use App\Http\Controllers\ClinicUser\AddTransactions\PrepTransaction;
use App\Http\Controllers\ClinicUser\AddTransactions\BoosterTransaction;
use App\Http\Controllers\ClinicUser\AddTransactions\AntiTetanusTransaction;
use App\Http\Controllers\ClinicUser\AddTransactions\OtherTransaction;
use App\Http\Controllers\ClinicUser\TwoFactorAuthenticationController;
use App\Http\Controllers\ClinicUser\ForgotPasswordController;
use App\Http\Controllers\ClinicUser\UpdatePasswordController;
use App\Http\Controllers\ClinicUser\ClinicUsersController;
use App\Http\Controllers\ClinicUser\InventorySupplies;
use App\Http\Controllers\ClinicUser\ManageInventorySupplies;
use App\Http\Controllers\ClinicUser\Services;
use App\Http\Controllers\ClinicUser\Payments;
use App\Http\Controllers\ClinicUser\Transactions;
use App\Http\Controllers\ClinicUser\MessagesController;

use App\Http\Controllers\ClinicUser\RegisterPatient\AntiTetanuRegistration;
use App\Http\Controllers\ClinicUser\RegisterPatient\BoosterRegistration;
use App\Http\Controllers\ClinicUser\RegisterPatient\OtherRegistration;
use App\Http\Controllers\ClinicUser\RegisterPatient\PepRegistration;
use App\Http\Controllers\ClinicUser\RegisterPatient\PrepRegistration;
use App\Http\Controllers\ClinicUser\StaffNurseVerificationController;use App\Http\Controllers\PatientTwoFactorAuthenticationController;
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

    Route::get('/clinic/patients/profile/{id}', [PatientsController::class, 'viewProfile'])
        ->name('clinic.patients.profile');

    Route::put('/clinic/patients/profile/update', [PatientsController::class, 'updateProfile'])
        ->name('clinic.patients.profile.update');

    Route::get('/clinic/patients/immunization_info/{id}/{transaction_id}', [PatientsController::class, 'viewImmunizationDetails'])
        ->name('clinic.patients.profile.immunization_info');

    Route::get('/clinic/patients/transactions/{id}', [PatientTransactionsController::class, 'index'])
        ->name('clinic.patients.transactions');

    // register patient routes
    // register anti-tetanus patient routes
    Route::get('/clinic/patients/register/anti-tetanus/{id}', [AntiTetanuRegistration::class, 'showForm'])
        ->name('clinic.patients.register.anti-tetanus');
    Route::post('/clinic/patients/register/anti-tetanus/register', [AntiTetanuRegistration::class, 'registerPatientAntiTetanu'])
        ->name('clinic.patients.register.anti-tetanus.register');

    // register booster patient routes
    Route::get('/clinic/patients/register/booster/{id}', [BoosterRegistration::class, 'showForm'])
        ->name('clinic.patients.register.booster');
    Route::post('/clinic/patients/register/booster/register', [BoosterRegistration::class, 'registerPatientBooster'])
        ->name('clinic.patients.register.booster.register');


    Route::get('/clinic/patients/register/other/{id}', [OtherRegistration::class, 'showForm'])
        ->name('clinic.patients.register.other');
    Route::post('/clinic/patients/register/other/register', [OtherRegistration::class, 'registerPatientOther'])
        ->name('clinic.patients.register.other.register');

    // register pep patient routes
    Route::get('/clinic/patients/register/pep/{id}', [PepRegistration::class, 'showForm'])
        ->name('clinic.patients.register.pep');
    Route::post('/clinic/patients/register/pep/register', [PepRegistration::class, 'registerPatientPEP'])
        ->name('clinic.patients.register.pep.register');


    // register prep patient routes
    Route::get('/clinic/patients/register/prep/{id}', [PrepRegistration::class, 'showForm'])
        ->name('clinic.patients.register.prep');
    Route::post('/clinic/patients/register/prep/register', [PrepRegistration::class, 'registerPatientPrep'])
        ->name('clinic.patients.register.prep.register');

    //Complete Transaction Immunization routes
    Route::get('/clinic/patients/complete-immunization/{schedule_id}/{service_id}/{grouping}/{patient_id}', [CompleteImmunizations::class, 'index'])
        ->name('clinic.patients.complete-immunization');
    Route::post('/clinic/patients/complete-immunization/complete', [CompleteImmunizations::class, 'completeImmunization'])
        ->name('clinic.patients.complete-immunization.complete');
        
    // Staff and Nurse Verification routes
    Route::post('/clinic/patients/verify-nurse', [StaffNurseVerificationController::class, 'verifyNurse'])
        ->name('clinic.patients.verify-nurse');
    Route::post('/clinic/patients/verify-staff', [StaffNurseVerificationController::class, 'verifyStaff'])
        ->name('clinic.patients.verify-staff');

    // New Transaction routes
    Route::get('/clinic/patients/new-transaction/{service_id}/{patient_id}', [PatientTransactionsController::class, 'newTransaction'])
        ->name('clinic.patients.new-transaction');
    // post exposure prophylaxis transaction
    Route::get('/clinic/patients/new-transaction/PEP/{service_id}/{patient_id}', [PepTransaction::class, 'showForm'])
        ->name('clinic.patients.new-transaction.pep');
    Route::post('/clinic/patients/new-transaction/PEP/add', [PepTransaction::class, 'addPepTransaction'])
        ->name('clinic.patients.new-transaction.pep.add');
    // pre exposure prophylaxis transaction
    Route::get('/clinic/patients/new-transaction/PREP/{service_id}/{patient_id}', [PrepTransaction::class, 'showForm'])
        ->name('clinic.patients.new-transaction.prep');
    Route::post('/clinic/patients/new-transaction/PREP/add', [PrepTransaction::class, 'addPrepTransaction'])
        ->name('clinic.patients.new-transaction.prep.add');
    // booster transaction
    Route::get('/clinic/patients/new-transaction/Booster/{service_id}/{patient_id}', [BoosterTransaction::class, 'showForm'])
        ->name('clinic.patients.new-transaction.booster');
    Route::post('/clinic/patients/new-transaction/Booster/add', [BoosterTransaction::class, 'addBoosterTransaction'])
        ->name('clinic.patients.new-transaction.booster.add');
    // anti-tetanus transaction
    Route::get('/clinic/patients/new-transaction/Anti-Tetanus/{service_id}/{patient_id}', [AntiTetanusTransaction::class, 'showForm'])
        ->name('clinic.patients.new-transaction.antitetanus');
    Route::post('/clinic/patients/new-transaction/Anti-Tetanus/add', [AntiTetanusTransaction::class, 'addAntiTetanusTransaction'])
        ->name('clinic.patients.new-transaction.antitetanus.add');
    // other transaction
    Route::get('/clinic/patients/new-transaction/Other/{service_id}/{patient_id}', [OtherTransaction::class, 'showForm'])
        ->name('clinic.patients.new-transaction.other');
    Route::post('/clinic/patients/new-transaction/Other/add', [OtherTransaction::class, 'addOtherTransaction'])
        ->name('clinic.patients.new-transaction.other.add');
    //----------------END-----------------------//

    // MESSAGES PAGE SMS---------------------------

    Route::get('/clinic/messages', [MessagesController::class, 'index'])
        ->name('clinic.messages');

    Route::post('/clinic/messages/send', [MessagesController::class, 'sendMessage'])
        ->name('clinic.messages.send');
    //----------------END-----------------------//

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


    //--------------------------END----------------------------------------------//


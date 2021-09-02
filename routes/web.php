<?php

use App\Http\Controllers\AuditorPermissionController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\BankDetailsController;
use App\Http\Controllers\ContactDetailsController;
use App\Http\Controllers\ContributionsController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\IdentificationController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\SinglePayslipController;
use App\Http\Controllers\PayslipController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupportTicketController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OtpLoginController;
use Inertia\Inertia;

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

Route::redirect('/', 'login');

Route::post('/upload', UploadController::class);

Route::group(['middleware' => ['guest'], 'as' => 'otp.', 'prefix' => 'admin/'], function () {
    Route::get('login', [OtpLoginController::class, 'index'])->name('index');
    Route::post('login', [OtpLoginController::class, 'login'])->name('login');
    Route::post('check', [OtpLoginController::class, 'check'])->name('check');
});

Route::middleware(['auth', 'role:system-admin|admin|employee'])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');


    Route::prefix('employees/{id}/edit')->name('employees.edit.')->group(function () {
        Route::get('identification-details', [IdentificationController::class, 'index'])->name('identification.index');
        Route::put('identification-details', [IdentificationController::class, 'update'])->name('identification.update');

        Route::get('contact-details', [ContactDetailsController::class, 'index'])->name('contact-details.index');
        Route::post('contact-details/number', [ContactDetailsController::class, 'storeNumber'])->name('contact-details.store.number');
        Route::post('contact-details/email', [ContactDetailsController::class, 'storeEmail'])->name('contact-details.store.email');
        Route::post('contact-details/address', [ContactDetailsController::class, 'storeAddress'])->name('contact-details.store.address');

        Route::delete('contact-details/{contactDetailsId}', [ContactDetailsController::class, 'destroyItem'])
            ->name('contact-details.item-destroy');

        Route::get('contributions', [ContributionsController::class, 'index'])->name('contributions.index');
        Route::put('contributions', [ContributionsController::class, 'update'])->name('contributions.update');

        Route::get('bank-details', [BankDetailsController::class, 'index'])->name('bank-details.index');
        Route::put('bank-details', [BankDetailsController::class, 'update'])->name('bank-details.update');

        Route::get('salary-details', [SalaryController::class, 'index'])->name('salary-details.index');
        Route::put('salary-details', [SalaryController::class, 'update'])->name('salary-details.update');

        Route::get('annual-leave', [LeaveController::class, 'index'])->name('annual-leave.index');
        Route::put('annual-leave', [LeaveController::class, 'update'])->name('annual-leave.update');
    });

    Route::prefix('employees/{id}')->name('employees.')->group(function () {
        Route::resource('documents', DocumentController::class)->except('destroy');
        Route::resource('payslips', SinglePayslipController::class)->except('destroy');
    });


    Route::resource('employees', EmployeeController::class)->except('destroy');
    //    Route::resource('payslips', SinglePayslipController::class)->except('destroy');
    Route::resource('locations', LocationController::class)->except('show');
    Route::resource('auditor-access', AuditorPermissionController::class)->except('show');
    Route::post('give-auditor-access', [AuditorPermissionController::class, 'giveAccess'])->name('auditor-access.give-access');
    Route::get('give-auditor-extra-access', [AuditorPermissionController::class, 'extraAccess'])->name('auditor-access.extra-access');
    Route::get('get-employee-list-auditor-access', [AuditorPermissionController::class, 'employeeList'])->name('auditor-access.employee-list');

    // User profile
    Route::get('/profile', [UserController::class, 'profile'])->name('users.profile');
    Route::put('/profile/update/{user}', [UserController::class, 'updateProfile'])
        ->name('users.profile.update');

    // Settings
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', [SettingController::class, 'index'])->name('index');

        Route::resource('users', UserController::class)->except('destroy');
        Route::resource('countries', CountryController::class)->except('show');
        Route::resource('cities', CityController::class)->except('show');
        Route::resource('banks', BankController::class)->except('show');
    });

    Route::get('/password', function () {
        return inertia('Users/Password');
    });
    Route::put('/update/password/{user}', [ProfileController::class, 'updatePassword'])->name('update.password');

    // Support Ticket
    Route::prefix('support-tickets')->name('supportTickets.')->group(function () {
        Route::get('/index', [SupportTicketController::class, 'adminIndex'])->name('index');
        Route::get('/show/{supportTicket}', [SupportTicketController::class, 'adminShow'])->name('show');
        Route::post('/store/chat/{id}', [SupportTicketController::class, 'storeChat'])->name('store.chat');
        Route::post('/update/status/{id}/{status}', [SupportTicketController::class, 'updateStatus'])->name('update.status');
    });


    Route::prefix('payslips')->name('payslips.')->group(function () {
        Route::get('/', [PayslipController::class, 'index'])->name('index');
        Route::get('/upload', [PayslipController::class, 'upload'])->name('upload');
    });
});

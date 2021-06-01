<?php

use App\Http\Controllers\AuditorPermissionController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\BankDetailsController;
use App\Http\Controllers\ContactDetailsController;
use App\Http\Controllers\ContributionsController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\IdentificationController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\SalaryController;
use Illuminate\Support\Facades\Route;
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

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified', 'role:system-admin|admin'])->name('dashboard');

Route::prefix('employees/{id}')->name('employees.')->group(function () {
    Route::get('identification-details', [IdentificationController::class, 'index'])->name('identification.index');
    Route::put('identification-details', [IdentificationController::class, 'update'])->name('identification.update');

    Route::get('contact-details', [ContactDetailsController::class, 'index'])->name('contact-details.index');

    Route::get('contributions', [ContributionsController::class, 'index'])->name('contributions.index');
    Route::put('contributions', [ContributionsController::class, 'update'])->name('contributions.update');

    Route::get('bank-details', [BankDetailsController::class, 'index'])->name('bank-details.index');
    Route::put('bank-details', [BankDetailsController::class, 'update'])->name('bank-details.update');

    Route::get('salary-details', [SalaryController::class, 'index'])->name('salary-details.index');
    Route::put('salary-details', [SalaryController::class, 'update'])->name('salary-details.update');

    Route::get('annual-leave', [LeaveController::class, 'index'])->name('annual-leave.index');

});

Route::resource('employees', EmployeeController::class)->except('destroy');

Route::resource('contact-details', ContactDetailsController::class)->except('show');
//Route::resource('contributions', ContributionsController::class)->except('show');
//Route::resource('salaries', SalaryController::class)->except('show');
Route::resource('locations', LocationController::class)->except('show');
Route::resource('banks', BankController::class)->except('show');
Route::resource('auditor-access', AuditorPermissionController::class)->except('show');
Route::resource('countries', CountryController::class)->except('show');

Route::get('/document', function() {
    return inertia('Employees/Document');
});

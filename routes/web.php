<?php

use App\Http\Controllers\ContactDetailsController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\ContributionsController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\AuditorPermissionController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\LocationController;
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

Route::resource('employees', EmployeeController::class)->except('show');
Route::resource('contact-details', ContactDetailsController::class)->except('show');
Route::resource('contributions', ContributionsController::class)->except('show');
Route::resource('salaries', SalaryController::class)->except('show');
Route::resource('locations', LocationController::class)->except('show');
Route::resource('banks', BankController::class)->except('show');
Route::resource('auditor-access', AuditorPermissionController::class)->except('show');
Route::resource('countries', CountryController::class)->except('show');

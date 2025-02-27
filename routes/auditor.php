<?php

/*
|--------------------------------------------------------------------------
| Auditor Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Http\Controllers\AuditorPermissionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auditor\DashboardController;
use Inertia\Inertia;

Route::get('/dashboard', DashboardController::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/employees', [AuditorPermissionController::class, 'employeeIndex'])->name('employees');
Route::get('/employees/show/{id}', [AuditorPermissionController::class, 'employeeShow'])->name('employees.show');

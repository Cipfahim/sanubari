<?php

/*
|--------------------------------------------------------------------------
| Employee Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\Employee\PayslipController;
use App\Http\Controllers\SupportTicketController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Employee\DashboardController;
use Inertia\Inertia;


Route::get('/dashboard', DashboardController::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('supportTickets',SupportTicketController::class)
    ->except('destroy')
    ->middleware(['auth', 'verified']);

Route::get('payslips', PayslipController::class)->name('payslips');


<?php

/*
|--------------------------------------------------------------------------
| System Admin Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\ActivityLogController;
use Illuminate\Support\Facades\Route;

Route::get('activity-logs', [ActivityLogController::class, 'index'])->name('activityLogs.index');
Route::get('activity-logs/{id}/show', [ActivityLogController::class, 'show'])->name('activityLogs.show');


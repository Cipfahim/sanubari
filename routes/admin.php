<?php

use App\Http\Controllers\HonorariumCategoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// HonorariumCategories
Route::resource('honorarium-categories', HonorariumCategoryController::class)->except('show');

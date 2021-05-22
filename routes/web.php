<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/prospects', [App\Http\Controllers\ProspectsController::class, 'index'])->name('prospects');
    Route::get('/prospects/get-data', [App\Http\Controllers\ProspectsController::class, 'getData'])->name('prospects.get-data');
    Route::get('/prospects/get-locations', [App\Http\Controllers\ProspectsController::class, 'getLocations'])->name('prospects.get-locations');
});

Auth::routes();

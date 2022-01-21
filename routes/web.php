<?php

use App\Http\Controllers\LeadSearchController;
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


use App\Http\Controllers\RingcentralController;
Route::get('callout',[RingcentralController::class, 'callout']);


Route::middleware(['auth'])->group(function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/prospects', [App\Http\Controllers\ProspectsController::class, 'index'])->name('prospects');
    Route::get('/prospects/get-data', [App\Http\Controllers\ProspectsController::class, 'getData'])->name('prospects.get-data');
    // Route::get('/prospects/get-locations', [App\Http\Controllers\ProspectsController::class, 'getLocations'])->name('prospects.get-locations');
    Route::get('/prospects/get-gyms', [App\Http\Controllers\ProspectsController::class, 'getGyms'])->name('prospects.get-gyms');
    Route::get('/twilio-test', [App\Http\Controllers\TwilioTestController::class, 'index'])->name('twilio-test');
    Route::post('/twilio-test', [App\Http\Controllers\TwilioTestController::class, 'storePhoneNumber']);
    Route::post('/twilio-test/custom', [App\Http\Controllers\TwilioTestController::class, 'sendCustomMessage']);
    Route::get('lead-search', [LeadSearchController::class, 'index'])->name('lead-search');
});

Auth::routes();


/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('admin-users')->name('admin-users/')->group(static function() {
            Route::get('/',                                             'AdminUsersController@index')->name('index');
            Route::get('/create',                                       'AdminUsersController@create')->name('create');
            Route::post('/',                                            'AdminUsersController@store')->name('store');
            Route::get('/{adminUser}/impersonal-login',                 'AdminUsersController@impersonalLogin')->name('impersonal-login');
            Route::get('/{adminUser}/edit',                             'AdminUsersController@edit')->name('edit');
            Route::post('/{adminUser}',                                 'AdminUsersController@update')->name('update');
            Route::delete('/{adminUser}',                               'AdminUsersController@destroy')->name('destroy');
            Route::get('/{adminUser}/resend-activation',                'AdminUsersController@resendActivationEmail')->name('resendActivationEmail');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::get('/profile',                                      'ProfileController@editProfile')->name('edit-profile');
        Route::post('/profile',                                     'ProfileController@updateProfile')->name('update-profile');
        Route::get('/password',                                     'ProfileController@editPassword')->name('edit-password');
        Route::post('/password',                                    'ProfileController@updatePassword')->name('update-password');
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('gym-staffs')->name('gym-staffs/')->group(static function() {
            Route::get('/',                                             'GymStaffController@index')->name('index');
            Route::get('/create',                                       'GymStaffController@create')->name('create');
            Route::post('/',                                            'GymStaffController@store')->name('store');
            Route::get('/{gymStaff}/edit',                              'GymStaffController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'GymStaffController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{gymStaff}',                                  'GymStaffController@update')->name('update');
            Route::delete('/{gymStaff}',                                'GymStaffController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('gym-locations')->name('gym-locations/')->group(static function() {
            Route::get('/',                                             'GymLocationsController@index')->name('index');
            Route::get('/create',                                       'GymLocationsController@create')->name('create');
            Route::post('/',                                            'GymLocationsController@store')->name('store');
            Route::get('/{gymLocation}/edit',                           'GymLocationsController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'GymLocationsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{gymLocation}',                               'GymLocationsController@update')->name('update');
            Route::delete('/{gymLocation}',                             'GymLocationsController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('gym-staff-types')->name('gym-staff-types/')->group(static function() {
            Route::get('/',                                             'GymStaffTypesController@index')->name('index');
            Route::get('/create',                                       'GymStaffTypesController@create')->name('create');
            Route::post('/',                                            'GymStaffTypesController@store')->name('store');
            Route::get('/{gymStaffType}/edit',                          'GymStaffTypesController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'GymStaffTypesController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{gymStaffType}',                              'GymStaffTypesController@update')->name('update');
            Route::delete('/{gymStaffType}',                            'GymStaffTypesController@destroy')->name('destroy');
        });
    });
});

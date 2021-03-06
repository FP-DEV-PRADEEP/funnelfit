<?php

use App\Http\Controllers\Api\ApiZapierProspectController;
use App\Http\Controllers\ApiZapierCalendlyController;
use App\Http\Controllers\RingcentralController;
use App\Http\Controllers\ZohoCallLogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/import-prospect', [ApiZapierProspectController::class, 'store']);
Route::post('/handle-call-log', [ZohoCallLogController::class, 'store']);

Route::post('handleCallback',[RingcentralController::class, 'handleCallback']);
Route::post('/import-calendly', [ApiZapierCalendlyController::class, 'store']);

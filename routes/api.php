<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->group(function () {
    Route::post('logout', [\App\Http\Controllers\AuthController::class, 'logout']);
    Route::post('send-sms', [\App\Http\Controllers\SmsReportsController::class, 'sendSms']);
    Route::get('sms-reports', [\App\Http\Controllers\SmsReportsController::class, 'smsReports']);
    Route::get('sms-report-details/{smsReport}', [\App\Http\Controllers\SmsReportsController::class, 'smsReportDetails']);
});

Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::post('signup', [\App\Http\Controllers\AuthController::class, 'signup']);

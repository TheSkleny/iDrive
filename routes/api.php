<?php

use App\Http\Controllers\ReportTypeController;
use App\Http\Controllers\LineController;
use App\Http\Controllers\DriverController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('report-types', [ReportTypeController::class, 'index']);
Route::get('lines', [LineController::class, 'index']);
Route::get('driver/{DriverId}', [DriverController::class, 'getDriverShifts']);

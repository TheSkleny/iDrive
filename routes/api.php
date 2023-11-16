<?php

use App\Http\Controllers\ReportTypeController;
use App\Http\Controllers\SearchLineController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\VehicleTypeController;
use App\Http\Controllers\LineDetailController;

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
Route::get('lines', [SearchLineController::class, 'index']);
Route::get('driver/{DriverId}', [DriverController::class, 'getDriverShifts']);
Route::get('vehicle-type', [VehicleTypeController::class, 'index']);
Route::get('line/{LineId}', [LineDetailController::class, 'getLineStops'])->where('LineId', '.*');

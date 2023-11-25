<?php

use App\Http\Controllers\ReportTypeController;
use App\Http\Controllers\SearchLineController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\VehicleTypeController;
use App\Http\Controllers\LineDetailController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\ReportController;

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
Route::get('lines', [SearchLineController::class, 'getLineList']);
Route::get('line-types', [SearchLineController::class, 'getLineTypes']);
Route::get('shifts/{DriverId}', [DriverController::class, 'getDriverShifts'])->where('DriverId', '.*');
Route::get('vehicle-type', [VehicleTypeController::class, 'index']);
Route::get('line/{LineId}', function ($lineId) {
    return [
        'lineStops' => app(LineDetailController::class)->getLineStops($lineId),
        'lineMatrixData' => app(LineDetailController::class)->getLineMatrixData($lineId)
    ];
})->where('LineId', '.*');
Route::get('vehicle/{VehicleId}', [VehicleController::class, 'getVehicleInfo'])->where('VehicleId', '.*');
Route::post('reports', [VehicleController::class, 'reportVehicleMalfunction']);
Route::get('reports/{StateId}', [ReportController::class, 'getReportsByState'])->where('StateId', '.*');
Route::post('reports/main', [ReportController::class, 'createMaintenanceReport']);
Route::patch('reports/{ReportId}', [ReportController::class, 'handleReport']);
Route::patch('reports/{ReportId}', [ReportController::class, 'closeReport']);
Route::get('reports_with_vehicle_info/{StateId}', [ReportController::class, 'getReportsByStateWithVehicleInfo'])
    ->where('StateId', '.*');
Route::get('report/{ReportId}', [ReportController::class, 'getReportById'])->where('ReportId', '.*');
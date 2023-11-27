<?php

use App\Http\Controllers\ReportTypeController;
use App\Http\Controllers\SearchLineController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\VehicleTypeController;
use App\Http\Controllers\LineDetailController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;

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

Route::middleware('auth:sanctum')->get('user', function (Request $request) {
    return $request->user();
});


// Endpoint: /search-line
Route::get('lines', [SearchLineController::class, 'getLineList']);
Route::get('line-types', [SearchLineController::class, 'getLineTypes']);

// Endpoint: /shifts
Route::get('shifts/{DriverId}', [DriverController::class, 'getDriverShifts'])
    ->where('DriverId', '.*');

// Endpoint: /lines/{LineId}
// TODO změnit na /lines/{LineId}
Route::get('line/{LineId}', function ($lineId) {
    return [
        'lineStops' => app(LineDetailController::class)->getLineStops($lineId),
        'lineMatrixData' => app(LineDetailController::class)->getLineMatrixData($lineId)
    ];
})->where('LineId', '.*');

// Endpoint: /vehicle/{VehicleId}
// TODO: Rename to vehicles/{VehicleId}
// TODO: Update a delete vehicles doimplementovat
Route::get('vehicle/{VehicleId}', [VehicleController::class, 'getVehicleInfo'])->where('VehicleId', '.*');
Route::post('reports', [VehicleController::class, 'reportVehicleMalfunction']);
Route::get('reports/{StateId}', [ReportController::class, 'getReportsByState'])
    ->where('StateId', '.*');
Route::post('reports/main', [ReportController::class, 'createMaintenanceReport']);
Route::patch('close-report/{ReportId}', [ReportController::class, 'closeReport']);
Route::patch('vehicles/{VehicleId}', [VehicleController::class, 'updateVehicleInfo']);

// Endpoint: /vehicles
// TODO: Post /vehicles ... doimplementovat
Route::get('reports_with_vehicle_info/{StateId}', [ReportController::class, 'getReportsByStateWithVehicleInfo'])
    ->where('StateId', '.*');
Route::get('vehicles-by-state/{StateId}', [VehicleController::class, 'getVehiclesByState'])->where('StateId', '.*');
Route::post('vehicles', [VehicleController::class, 'addVehicle']);
Route::delete('vehicles/{VehicleId}', [VehicleController::class, 'deleteVehicle']);

// Endpoint: /reports/{ReportId}
// TODO změnit na /reports/{ReportId}
Route::get('report/{ReportId}', [ReportController::class, 'getReportById'])->where('ReportId', '.*');
Route::patch('handle-report/{ReportId}', [ReportController::class, 'handleReport']);

// Endpoint: /reports
// TODO změnit na /reports a možná nějakej general user-by-type endpoint
// GET /reports ... zbytek přes query parametry
Route::get('reports-by-technician/{TechnicianId}', [ReportController::class, 'getReportByTechnicianId'])->where('TechnicianId', '.*');
Route::get('user-by-type/{UserType}', [UserController::class, 'getUsersByType'])->where('UserType', '.*');

// Správa uživatelů
Route::get('users', [UserController::class, 'getUsers']);
Route::post('users', [UserController::class, 'addUser']);
Route::patch('users/{UserId}', [UserController::class, 'updateUserInfo']);
Route::delete('users/{UserId}', [UserController::class, 'deleteUser']);

// Jsou tyhle endpointy potřeba?
Route::get('reports/{StateId}', [ReportController::class, 'getReportsByState'])
    ->where('StateId', '.*');
Route::patch('reports/{ReportId}', [ReportController::class, 'closeReport']);
Route::get('vehicle-type', [VehicleTypeController::class, 'index']);
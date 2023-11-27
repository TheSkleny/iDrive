<?php

use App\Http\Controllers\ReportTypeController;
use App\Http\Controllers\SearchLineController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\VehicleTypeController;
use App\Http\Controllers\LineDetailController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LinksController;
use App\Enums\UserTypeEnum;
use App\Enums\VehicleStateEnum;
use App\Enums\ReportStateEnum;

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


// Endpoint: /search-lines
Route::get('search-lines', function() {
    return [
        'lineList' => app(SearchLineController::class)->getLineList(),
        'lineTypes' => app(SearchLineController::class)->getLineTypes()
    ];
});

// Endpoint: /shifts/{DriverId}
Route::get('shifts/{DriverId}', [DriverController::class, 'getDriverShifts']);

// Endpoint: /lines/{LineId}
Route::get('lines/{LineId}', function ($lineId) {
    return [
        'lineStops' => app(LineDetailController::class)->getLineStops($lineId),
        'lineMatrixData' => app(LineDetailController::class)->getLineMatrixData($lineId)
    ];
});

// Endpoint: /vehicles/{VehicleId}
// TODO: Update vehicles doimplementovat FE
Route::get('vehicles/{VehicleId}', function ($vehicleId) {
    return [
        'vehicleInfo' => app(VehicleController::class)->getVehicleInfo($vehicleId),
        'techniciansList' => app(UserController::class)->getUsersByType(UserTypeEnum::TECHNICIAN->value)
    ];
});
Route::post('reports/malfunctions', [VehicleController::class, 'reportVehicleMalfunction']);
Route::post('reports/maintenances', [ReportController::class, 'createMaintenanceReport']);
Route::patch('vehicles/{VehicleId}', [VehicleController::class, 'updateVehicleInfo']);
Route::delete('vehicles/{VehicleId}', [VehicleController::class, 'deleteVehicle']);

// Endpoint: /vehicles
Route::get('vehicles', function() {
    return [
        'vehicleReports' => app(ReportController::class)->getReportsByStateWithVehicleInfo(ReportStateEnum::REPORTED->value),
        'operationalVehicles' => app(VehicleController::class)->getVehiclesByState(VehicleStateEnum::OPERATIONAL->value),
        'outOfServiceVehicles' => app(VehicleController::class)->getVehiclesByState(VehicleStateEnum::OUT_OF_SERVICE->value)
    ];
});
Route::post('vehicles', [VehicleController::class, 'addVehicle']);

// Endpoint: /reports/{ReportId}
Route::get('reports/{ReportId}', function($reportId) {
    return [
        'reportInfo' => app(ReportController::class)->getReportById($reportId),
        'techniciansList' => app(UserController::class)->getUsersByType(UserTypeEnum::TECHNICIAN->value)
    ];
});
Route::patch('handle-report/{ReportId}', [ReportController::class, 'handleReport']);
Route::patch('close-report/{ReportId}', [ReportController::class, 'closeReport']);

// Endpoint: /repairs
Route::get('repairs/{TechnicianId}', function($technicianId) {
    return [
        'repairsList' => app(ReportController::class)->getReportByTechnicianId($technicianId),
        'techniciansList' => app(UserController::class)->getUsersByType(UserTypeEnum::TECHNICIAN->value)
    ];
});
Route::get('reports-by-technician/{TechnicianId}', [ReportController::class, 'getReportByTechnicianId'])->where('TechnicianId', '.*');
Route::get('user-by-type/{UserType}', [UserController::class, 'getUsersByType'])->where('UserType', '.*');

// Správa uživatelů
Route::get('users', [UserController::class, 'getUsers']);
Route::get('users/{UserId}', [UserController::class, 'getUser']);
Route::patch('users/{UserId}', [UserController::class, 'updateUserInfo']);
Route::delete('users/{UserId}', [UserController::class, 'deleteUser']);

// Jsou tyhle endpointy potřeba?
Route::get('reports/{StateId}', [ReportController::class, 'getReportsByState'])
    ->where('StateId', '.*');
Route::patch('reports/{ReportId}', [ReportController::class, 'closeReport']);
Route::get('vehicle-type', [VehicleTypeController::class, 'index']);

Route::get('allocations', function () {
    return [
        'allocatedLinks' => app(LinksController::class)->getAllocatedLinks(),
        'nonAllocatedLinks' => app(LinksController::class)->getNonAllocatedLinks(),
        'vehicles' => app(VehicleController::class)->getVehiclesByState(VehicleStateEnum::OPERATIONAL->value),
        'drivers' => app(UserController::class)->getUsersByType(UserTypeEnum::DRIVER->value)
    ];
});
Route::patch('allocations/{linkId}', [LinksController::class, 'allocateLink']);


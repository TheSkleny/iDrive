<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Enums\UserTypeEnum;

// Define the mapping between user types and their values



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
    return redirect('/search-lines');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', function () {
        return Inertia::render('Base', ['c' => 'Edit',
            'args' => ['UserType' => auth()->user() ? auth()->user()->type_id : 0]]);
    })->name('profile');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/search-lines', function () {
    return Inertia::render('Base', ['c' => 'SearchLine',
        'args' => ['UserType' => auth()->user() ? auth()->user()->type_id : 0]]);
})->name('search-lines');

Route::get('/shifts', function () {
    return Inertia::render('Base', ['c' => 'DriverShifts',
        'args' => ['driverId' => auth()->user()->Id, 'UserType' => auth()->user()->type_id]]);
})->name('shifts')->middleware(['auth', 'verified', 'usertype:' . UserTypeEnum::DRIVER->value]);

Route::get('/lines/{lineId}', function ($lineId) {
    return Inertia::render('Base', ['c' => 'LineDetail',
        'args' => ['lineId' => $lineId, 'UserType' => auth()->user() ? auth()->user()->type_id : 0]]);
})->where('lineId', '.*');

Route::get('/vehicles/{vehicleId}', function ($vehicleId) {
    return Inertia::render('Base', ['c' => 'VehicleDetail',
        'args' => ['submitterId' => auth()->user()->Id, 'vehicleId' => $vehicleId,
            'UserType' => auth()->user()->type_id]]);
})->where('vehicleId', '.*')->middleware(['auth', 'verified']);;

Route::get('/vehicles', function () {
    return Inertia::render('Base', ['c' => 'Vehicles',
        'args' => ['UserType' => auth()->user()->type_id]]);
})->name('vehicles')->middleware(['auth', 'verified', 'usertype:' . UserTypeEnum::MANAGER->value]);

Route::get('/reports/{reportId}', function ($reportId) {
    return Inertia::render('Base', ['c' => 'ReportDetail',
        'args' => ['reportId' => $reportId, 'UserType' => auth()->user()->type_id]]);
})->where('reportId', '.*')->middleware(['auth', 'verified']);

Route::get('/repairs', function () {
    return Inertia::render('Base', ['c' => 'Repairs',
        'args' => ['technicianId' => auth()->user()->Id, 'UserType' => auth()->user()->type_id]]);
})->name('repairs')->middleware(['auth', 'verified', 'usertype:' . UserTypeEnum::TECHNICIAN->value]);

Route::get('/users', function () {
    return Inertia::render('Base', ['c' => 'Users',
        'args' => ['UserId' => auth()->user()->Id, 'UserType' => auth()->user()->type_id]]);
})->name('users')->middleware(['auth', 'verified', 'usertype:' . UserTypeEnum::ADMIN->value]);

Route::get('/edit-user/{userId}', function ($userId) {
    return Inertia::render('Base', ['c' => 'EditUser',
        'args' => ['UserId' => $userId, 'UserType' => auth()->user()->type_id]]);
})->name('edit-user')->middleware(['auth', 'verified', 'usertype:' . UserTypeEnum::ADMIN->value]);

Route::get('/allocate', function () {
    return Inertia::render('Base', ['c' => 'DispatcherAllocate',
        'args' => ['UserType' => auth()->user()->type_id]]);
})->name('allocate')->middleware(['auth', 'verified', 'usertype:' . UserTypeEnum::DISPATCHER->value]);

Route::get('/edit-vehicles/{vehicleId}', function ($vehicleId) {
    return Inertia::render('Base', ['c' => 'VehicleEdit',
        'args' => ['vehicleId' => $vehicleId, 'UserType' => auth()->user()->type_id]]);
})->where('vehicleId', '.*')->middleware(['auth', 'verified', 'usertype:' . UserTypeEnum::MANAGER->value]);

Route::get('/lines', function () {
    return Inertia::render('Base', ['c' => 'Lines',
        'args' => ['UserType' => auth()->user()->type_id]]);
})->name('lines')->middleware(['auth', 'verified', 'usertype:' . UserTypeEnum::MANAGER->value]);

Route::get('/links', function () {
    return Inertia::render('Base', ['c' => 'Links',
        'args' => ['UserType' => auth()->user()->type_id]]);
})->name('links')->middleware(['auth', 'verified', 'usertype:' . UserTypeEnum::MANAGER->value]);

Route::get('/edit-link/{linkId}', function ($linkId) {
    return Inertia::render('Base', ['c' => 'EditLink',
        'args' => ['linkId' => $linkId, 'UserType' => auth()->user()->type_id]]);
})->where('linkId', '.*')->middleware(['auth', 'verified', 'usertype:' . UserTypeEnum::MANAGER->value]);

require __DIR__.'/auth.php';

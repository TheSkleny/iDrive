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
    return redirect('/search-line');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', function () {
        return Inertia::render('Base', ['c' => 'Edit']);
    })->name('profile');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/search-line', function () {
    return Inertia::render('Base', ['c' => 'SearchLine', 'args' => ['UserType' => auth()->user() ? auth()->user()->type_id : 0]]);
})->name('search-line');

Route::get('/shifts', function () {
    return Inertia::render('Base', ['c' => 'Driver',
        'args' => ['driverId' => auth()->user()->Id, 'UserType' => auth()->user()->type_id]]);
})->name('shifts')->middleware(['auth', 'verified', 'usertype:' . UserTypeEnum::DRIVER->value]);

Route::get('/line/{lineId}', function ($lineId) {
    return Inertia::render('Base', ['c' => 'LineDetail',
        'args' => ['lineId' => $lineId, 'UserType' => auth()->user()->type_id]]);
})->where('lineId', '.*');

Route::get('/vehicle/{vehicleId}', function ($vehicleId) {
    return Inertia::render('Base', ['c' => 'VehicleDetail',
        'args' => ['submitterId' => auth()->user()->Id, 'vehicleId' => $vehicleId,
            'UserType' => auth()->user()->type_id]]);
})->where('vehicleId', '.*')->middleware(['auth', 'verified']);;

Route::get('/vehicles', function () {
    return Inertia::render('Base', ['c' => 'Vehicles',
        'args' => ['UserType' => auth()->user()->type_id]]);
})->name('vehicles')->middleware(['auth', 'verified', 'usertype:' . UserTypeEnum::SUPERVISOR->value]);

Route::get('/report/{reportId}', function ($reportId) {
    return Inertia::render('Base', ['c' => 'ReportDetail',
        'args' => ['reportId' => $reportId, 'UserType' => auth()->user()->type_id]]);
})->where('reportId', '.*')->middleware(['auth', 'verified']);

Route::get('/repairs', function () {
    return Inertia::render('Base', ['c' => 'Repairs',
        'args' => ['technicianId' => auth()->user()->Id, 'UserType' => auth()->user()->type_id]]);
})->name('repairs')->middleware(['auth', 'verified', 'usertype:' . UserTypeEnum::TECHNICIAN->value]);


require __DIR__.'/auth.php';

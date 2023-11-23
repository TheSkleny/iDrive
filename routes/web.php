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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('welcome');

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

Route::get('/report-types', function () {
    return Inertia::render('Base', ['c' => 'ReportTypes']);
})->name('report-types');

Route::get('/search-line', function () {
    return Inertia::render('Base', ['c' => 'SearchLine']);
})->name('search-line');

Route::get('/shifts', function () {
    return Inertia::render('Base', ['fc' => 'Driver', 'args' => ['driverId' => auth()->user()->Id]]);
})->name('shifts')->middleware(['auth', 'verified', 'usertype:1']);

Route::get('/line/{lineId}', function ($lineId) {
    return Inertia::render('Base', ['c' => 'LineDetail', 'args' => ['lineId' => $lineId]]);
})->where('lineId', '.*');

Route::get('/vehicle/{vehicleId}', function ($vehicleId) {
    return Inertia::render('Base', ['c' => 'VehicleDetail', 'args' => ['submitterId' => auth()->user()->Id, 'vehicleId' => $vehicleId]]);
})->where('vehicleId', '.*')->middleware(['auth', 'verified']);;

require __DIR__.'/auth.php';

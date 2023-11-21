<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/report-types', function () {
    return Inertia::render('Base', ['c' => 'ReportTypes']);
})->name('report-types');

Route::get('/search-line', function () {
    return Inertia::render('Base', ['c' => 'SearchLine']);
})->name('search-line');

Route::get('/driver', function () {
    return Inertia::render('Base', ['c' => 'Driver']);
})->name('driver');
Route::get('/line/{lineId}', function ($lineId) {
    return Inertia::render('Base', ['c' => 'LineDetail', 'args' => ['lineId' => $lineId]]);
})->where('lineId', '.*');
Route::get('/vehicle/{vehicleId}', function ($vehicleId) {
    return Inertia::render('Base', ['c' => 'VehicleDetail', 'args' => ['vehicleId' => $vehicleId]]);
})->where('vehicleId', '.*');

require __DIR__.'/auth.php';

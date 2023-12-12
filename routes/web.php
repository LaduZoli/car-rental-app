<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\BookingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Public
Route::get('/', function () {
    return view('public/date-picker');
})->name('home');



Route::get('/list-of-cars', [CarController::class, 'showAvailableCars'])->name('available.cars');

Route::get('/car-booking/{carId}', [CarController::class, 'showBookingForm'])->name('car.booking');

Route::post('/car/booking/submit', [CarController::class, 'store'])->name('car.booking.submit');



// Admin 
Route::middleware(['admin'])->group(function () {
    Route::get('/admin',  [AdminController::class, 'dashboard']);
    Route::get('/admin',  [BookingController::class, 'index']);
    Route::get('/car-edit', [CarController::class, 'index'])->name('index');
    Route::get('/car-edit/{carId}', [CarController::class, 'edit'])->name('cars.edit');
    Route::put('/car-update/{carId}', [CarController::class, 'update'])->name('car.update');
    Route::post('/car-create', [CarController::class, 'create'])->name('car.create');
    Route::get('/car-create', function(){ return view('/admin/car-create');});
});



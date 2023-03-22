<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AdminController;
use App\Models\Reservation;

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

Route::get('/', [WelcomeController::class, 'welcome'])->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard/reservations', [AdminController::class, 'showAdmResPage'])->middleware(['auth', 'verified'])->name('adm/reservations');

Route::get('/dashboard/cars', [AdminController::class, 'showAdmAddCarsPage'])->middleware(['auth', 'verified'])->name('adm/cars');

Route::get('/dashboard/reservation/cancel', [AdminController::class, 'cancelRes'])->middleware(['auth', 'verified'])->name('adm/reservations/cancel');

Route::get('/dashboard/cars/create', [AdminController::class, 'showCarCreationForm'])->middleware(['auth', 'verified'])->name('adm/cars/create');

Route::post('/dashboard/cars/create', [AdminController::class, 'doAddCar'])->middleware(['auth', 'verified'])->name('adm/cars/create');

Route::get('/dashboard/cars/delete', [AdminController::class, 'deleteCar'])->middleware(['auth', 'verified'])->name('adm/cars/delete');

Route::get('/reservation', [ReservationController::class, 'showReservationPage'])->name('reservationPage');

Route::post("/reservation", [ReservationController::class, 'createReservation'])->name('createReservation');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__ . '/auth.php';

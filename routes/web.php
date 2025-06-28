<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomController2;
use App\Http\Controllers\TestingController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

/**
 * Welcome Controller
 */
Route::get('/', WelcomeController::class)->name('home');

/**
 * Dashboard
 */
Route::middleware(['auth', 'verified'])
    ->controller(DashboardController::class)
    ->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
    });

/**
 * Reservation
 */
Route::middleware(['auth'])->group(function () {
    Route::controller(ReservationController::class)
        ->prefix('reservations')
        ->name('reservations.')
        ->group(function () {
            Route::get('/my', 'my')->name('my');
            Route::post('/{reservation}/status', 'updateStatus')->name('updateStatus');
        });
});


Route::middleware(['auth'])->group(function () {

    Route::get('/bookings/report', [App\Http\Controllers\BookingReportController::class, 'index'])
        ->name('bookings.report');

    Route::get('/bookings/report/export', [App\Http\Controllers\BookingReportController::class, 'export'])
        ->name('bookings.report.export');
});

/**
 * Room
 */
Route::middleware(['auth'])->group(function () {
    Route::controller(RoomController2::class)
        ->prefix('rooms')
        ->name('rooms.')
        ->group(function () {
            Route::get('/available', 'available')->name('available');
            Route::post('/{reservation}/make-available', 'makeAvailable')->name('makeAvailable');
            Route::post('/{reservation}/make-out-of-service', 'makeOOS')->name('makeOOS');
        });
});

/**
 * for Seeding Room and Room Images
 */
Route::prefix('testing')
    ->name('testing.')
    ->controller(TestingController::class)
    ->group(function () {
        Route::get('/seed', 'seed');
    });

/**
 * Settings
 */
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

/**
 * Reservations Resources
 */
Route::middleware(['auth'])->group(function () {
    Route::resource('reservations', ReservationController::class)->names('reservations');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/resources.php';

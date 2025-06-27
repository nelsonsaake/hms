<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReservationController;
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
    ->name('dashboard')
    ->group(function () {
        Route::get('/dashboard', 'index');
    });

/**
 * Self Service or Reservation
 */
Route::middleware(['auth'])->group(function () {
    Route::resource('reservations', ReservationController::class)->names('reservations');
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

require __DIR__ . '/auth.php';
require __DIR__ . '/resources.php';

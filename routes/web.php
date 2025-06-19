<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('dashboard');
})->name('home');

Route::middleware(['auth', 'verified'])->get('/dashboard', function () {
    // return view('dashboard');
    return redirect()->route('bookings.index');
})->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
require __DIR__.'/resources.php';

<?php

use App\Enums\RoomType;
use App\Models\Room;
use App\Models\RoomImage;
use App\Services\RoomImageSeederService;
use App\Services\RoomSeederService;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {

    $rooms = Room::with('roomImages')
        ->where('status', 'available')
        ->get();

    return view(
        'welcome',
        compact('rooms')
    );
})->name('home');

Route::middleware(['auth', 'verified'])->get('/dashboard', function () {
    // return view('dashboard');
    return redirect()->route('bookings.index');
})->name('dashboard');

Route::any('/test', function (
    RoomSeederService $roomSeederService,
    RoomImageSeederService $roomImageSeederService,
) {
    $roomSeederService->run();
    $roomImageSeederService->run();
});

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/resources.php';

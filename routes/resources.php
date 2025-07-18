
<?php

use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\RoomImageController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::resource('rooms', RoomController::class)->names('rooms');
    Route::resource('users', UserController::class)->names('users');
    Route::resource('bookings', BookingController::class)->names('bookings');
    Route::resource('room-images', RoomImageController::class)->names('room_images');

});


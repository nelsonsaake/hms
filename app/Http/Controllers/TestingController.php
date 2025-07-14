<?php

namespace App\Http\Controllers;

use App\Mail\BookingReceived;
use App\Mail\BookingStatusChanged;
use App\Models\Booking;
use Database\Seeders\HMSRoomImageSeeder;
use Database\Seeders\HMSRoomSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TestingController extends Controller
{
    /**
     * Make room details and room images make sense
     * 
     * @param \Database\Seeders\HMSRoomSeeder $roomSeederService
     * @param \Database\Seeders\HMSRoomImageSeeder $roomImageSeederService
     * @return  
     */
    public function seed(
        HMSRoomSeeder $roomSeederService,
        HMSRoomImageSeeder $roomImageSeederService,
    ) {
        $roomSeederService->run();
        $roomImageSeederService->run();
    }

    public function mail()
    {
        $booking = Booking::first();
        Mail::to("nelsonsaakekofi@gmail.com")
            ->send(new BookingStatusChanged($booking));
        // ->send(new BookingReceived($booking));
    }

    public function preview()
    {
        $reservation = Booking::inRandomOrder()->first();
        return view('emails.booking_received', compact('reservation'));
        return view('emails.booking_status_changed', compact('reservation'));
    }
}

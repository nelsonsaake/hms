<?php

namespace App\Http\Controllers;

use App\Enums\Roles;
use App\Models\Booking;
use App\Repositories\ReservationRepository;
use App\Repositories\RoomRepository;
use App\Services\ReservationService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(
        protected ReservationRepository $reservationRepository,
        protected RoomRepository $roomRepository
    ) {}

    public function index()
    {
        if (authUser()->hasRole(Roles::ADMINISTRATOR)) {
            return redirect()->route('bookings.index');
        }

        return redirect()->route('reservations.my');
    }
}

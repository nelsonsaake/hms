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
        protected RoomRepository $roomRepository,
        protected ReservationService $reservationService
    ) {}

    public function index()
    {
        if (authUser()->hasRole(Roles::ADMINISTRATOR)) {
            return redirect()->route('bookings.index');
        }

        return redirect()->route('reservations.index');
    }

    public function reservations(Request $request)
    {
        $reservations =  $this->reservationRepository->paginate($request->all());
        return view('reservations', compact('reservations'));
    }

    public function rooms(Request $request)
    {
        $rooms = $this->roomRepository->paginate($request->all());
        return view('rooms', compact('rooms'));
    }

    public function checkIn(Request $request, Booking $reservation)
    {
        $this->reservationService->checkIn($reservation);
        return redirect()->route('reservations');
    }

    public function checkOut(Request $request, Booking $reservation)
    {
        $this->reservationService->checkOut($reservation);
        return redirect()->route('reservations');
    }
}

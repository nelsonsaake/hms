<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\BookingStatusNextOptions;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Models\Booking;
use App\Models\User;
use App\Models\Room;
use App\Repositories\ReservationRepository;
use App\Services\ReservationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class ReservationController extends Controller
{
    public function __construct(
        protected ReservationRepository $reservationRepository,
        protected ReservationService $reservationService,
    ) {}

    /**
     * Display a listing of the booking.
     *
     * @return
     */
    public function reservations(Request $request)
    {
        $reservations =  $this->reservationRepository->paginate($request->all());
        return view('reservations.index', compact('reservations'));
    }

    /**
     * Display a listing of the booking for the current user only
     *
     * @return
     */
    public function my(Request $request)
    {
        // restrict to current user
        $request->merge([
            'user_id' => authUser()->id,
        ]);

        try {
            $reservations = $this->reservationRepository->paginate($request->all());
            return view('reservations.my', compact('reservations'));
        } catch (\Exception $e) {
            Log::debug("Error getting reservations: " . $e->getMessage());
            $msg = 'Something went wrong getting reservations, please try again later.';
            return redirect()->back()->withErrors($msg);
        }
    }

    /**
     * Create booking view.
     *
     * @param  Request  $request
     * @return
     */
    public function create(Request $request)
    {
        try {
            $users = User::all();
            $rooms = Room::all();

            return view(
                'reservations.create',
                compact('users', 'rooms'),

            );
        } catch (\Exception $e) {
            $msg = 'Something went wrong create reservation view, please try again later.';
            return redirect()->back()->withErrors($msg);
        }
    }

    /**
     * Store a newly created reservation in storage.
     *
     * @param  StoreReservationRequest  $request
     * @return
     */
    public function store(StoreReservationRequest $request)
    {
        try {
            $reservation = $this->reservationRepository->create($request->all());
            return redirect()
                ->route('reservations.my')
                ->with('success', 'Create reservation successful');
        } catch (\Exception $e) {
            Log::debug("Error creating reservation: " . $e->getMessage());
            $msg = 'Something went wrong creating reservation, please try again later.';
            dd($e->getMessage());
            return redirect()->back()->with('error', $msg);
        }
    }

    /**
     * Display the specified reservation.
     *
     * @param  \App\Models\Booking  $booking
     * @return
     */
    public function show(Booking $reservation)
    {
        // Gate::authorize('view', $reservation);

        return view(
            'reservations.show',
            compact('reservation'),
        );
    }

    /**
     * Display the specified reservation.
     *
     * @param  \App\Models\Booking  $reservation
     * @return
     */
    public function edit(Booking $reservation)
    {
        // Gate::authorize('view', $reservation);

        try {
            $users = User::all();
            $rooms = Room::all();

            return view(
                'reservations.edit',
                compact(
                    'reservation',
                    'users',
                    'rooms'
                ),
            );
        } catch (\Exception $e) {
            $msg = 'Something went wrong create reservation view, please try again later.';
            return redirect()->back()->withErrors($msg);
        }
    }

    /**
     * Update the specified booking in storage.
     *
     * @param  UpdateBookingRequest  $request
     * @param  \App\Models\Booking  $booking
     * @return
     */
    public function update(UpdateBookingRequest $request, Booking $reservation)
    {
        // Gate::authorize('update', $reservation);

        try {
            $this->reservationRepository->update($reservation, $request->all());
            return redirect()
                ->route('reservations.my')
                ->with('success', 'Update reservation successful');
        } catch (\Exception $e) {
            Log::debug("Error updating reservation: " . $e->getMessage());
            return redirect()->back()->withErrors(
                'Something went wrong updating the reservation, please try again later.'
            );
        }
    }

    public function updateStatus(Request $request, Booking $reservation)
    {
        // $this->authorize('modify', $reservation);

        $new = $request->input('status');
        if (!in_array($new, BookingStatusNextOptions::options($reservation->status), true)) {
            return redirect()->back()->with('error', 'Invalid status transition.');
        }

        $reservation->update(['status' => $new]);
        return redirect()->back()->with('success', 'Reservations ' . efmt($new) . ' successfully.');
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

    /**
     * Remove the specified booking from storage.
     *
     * @param  \App\Models\Booking  $reservation
     * @return
     */
    public function destroy(Booking $reservation)
    {
        // Gate::authorize('delete', $reservation);

        try {
            $this->reservationRepository->destroy($reservation);
            return redirect()
                ->route('reservations.my')
                ->with('success', 'Reservation deleted successfully.');
        } catch (\Exception $e) {
            Log::debug("Error deleting reservation: " .  $e->getMessage());
            return redirect()->back()->withErrors(
                'Something went wrong deleting the reservation, please try again later.'
            );
        }
    }
}

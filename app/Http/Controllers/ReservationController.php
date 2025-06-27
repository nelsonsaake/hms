<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Models\Booking;
use App\Models\User;
use App\Models\Room;
use App\Repositories\BookingRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class ReservationController extends Controller
{
    public function __construct(
        protected BookingRepository $bookingRepository,
    ) {}

    /**
     * Display a listing of the booking.
     *
     * @return
     */
    public function index(Request $request)
    {
        // restrict to current user
        $request->merge([
            'user_id' => authUser()->id,
        ]);

        try {
            $reservations = $this->bookingRepository->paginate($request->all());
            return view('reservations.index', compact('reservations'));
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
     * @param  StoreBookingRequest  $request
     * @return
     */
    public function store(StoreBookingRequest $request)
    {
        try {
            $reservation = $this->bookingRepository->create($request->all());
            return redirect()
                ->route('reservations.index')
                ->with('success', 'Create reservation successful');
        } catch (\Exception $e) {
            Log::debug("Error creating reservation: " . $e->getMessage());
            $msg = 'Something went wrong creating reservation, please try again later.';
            return redirect()->back()->withErrors($msg);
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
            $reservations = $this->bookingRepository->update($reservation, $request->all());
            return redirect()
                ->route('reservations.index')
                ->with('success', 'Update reservation successful');
        } catch (\Exception $e) {
            Log::debug("Error updating reservation: " . $e->getMessage());
            return redirect()->back()->withErrors(
                'Something went wrong updating the reservation, please try again later.'
            );
        }
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
            $this->bookingRepository->destroy($reservation);
            return redirect()
                ->route('reservations.index')
                ->with('success', 'Reservation deleted successfully.');
        } catch (\Exception $e) {
            Log::debug("Error deleting reservation: " .  $e->getMessage());
            return redirect()->back()->withErrors(
                'Something went wrong deleting the reservation, please try again later.'
            );
        }
    }
}

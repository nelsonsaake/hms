<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Controller; 
use App\Http\Request\StoreBookingRequest;
use App\Http\Request\UpdateBookingRequest;
use App\Http\Resources\BookingResource;
use App\Models\Booking;
use App\Models\User;
use App\Models\Room;
use App\Repositories\BookingRepository; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    public function __construct(
        protected BookingRepository $bookingRepository, 
    ) {
    }

    /**
     * Display a listing of the booking.
     *
     * @return
     */
    public function index(Request $request)
    {
        Gate::authorize('viewAny', Booking::class);

        try {  
            $bookings = $this->bookingRepository->paginate($request->all());
            return view('bookings.index', compact('bookings'));
        } catch (\Exception $e) {
            Log::debug ("Error getting booking: " . $e->getMessage());
            $msg = 'Something went wrong getting bookings, please try again later.';
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
        Gate::authorize('create', Booking::class);

        try { 
            $users = User::all();
            $rooms = Room::all();

            return view(
                'bookings.create', 
                compact('users','rooms'),

            );
        } catch (\Exception $e) {
            $msg = 'Something went wrong building create booking view, please try again later.';
            return redirect()->back()->withErrors($msg);
        }
    }

    /**
     * Store a newly created booking in storage.
     *
     * @param  StoreBookingRequest  $request
     * @return
     */
    public function store(StoreBookingRequest $request)
    {
        Gate::authorize('create', Booking::class);

        try { 
            $booking = $this->bookingRepository->create($request->all()); 
            return redirect()
                ->route('bookings.index')
                ->with('success', 'Create booking successful');
        } catch (\Exception $e) {
            Log::debug ("Error creating booking: " . $e->getMessage());
            $msg = 'Something went wrong creating booking, please try again later.';
            return redirect()->back()->withErrors($msg);
        }
    }

    /**
     * Display the specified booking.
     *
     * @param  \App\Models\Booking  $booking
     * @return
     */
    public function show(Booking $booking)
    {
        Gate::authorize('view', $booking);

        return view(
            'bookings.show', 
            compact('booking'),
        );
    }

    /**
     * Display the specified booking.
     *
     * @param  \App\Models\Booking  $booking
     * @return
     */
    public function edit(Booking $booking)
    {
        Gate::authorize('view', $booking);

        try { 
            $users = User::all();
            $rooms = Room::all();

            return view(
                'bookings.edit', 
                compact(
                    'booking','users','rooms'),
            );
        } catch (\Exception $e) {
            $msg = 'Something went wrong building create booking view, please try again later.';
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
    public function update(UpdateBookingRequest $request, Booking $booking)
    {
        Gate::authorize('update', $booking);

        try {
            $booking = $this->bookingRepository->update($booking, $request->all());
            return redirect()
                ->route('bookings.index')
                ->with('success', 'Update booking successful');
        } catch (\Exception $e) {
            Log::debug ("Error updating booking: " . $e->getMessage());
             return redirect()->back()->withErrors(
                'Something went wrong updating the booking, please try again later.'
            );
        } 
    }

    /**
     * Remove the specified booking from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return
     */
    public function destroy(Booking $booking)
    {
        Gate::authorize('delete', $booking);

        try {
            $this->bookingRepository->destroy($booking);
            return redirect()
                ->route('bookings.index')
                ->with('success', 'Booking deleted successfully.');
        } catch (\Exception $e) {
            Log::debug ("Error deleting booking: " .  $e->getMessage());
             return redirect()->back()->withErrors(
                'Something went wrong deleting the booking, please try again later.'
            );
        } 
    }
}


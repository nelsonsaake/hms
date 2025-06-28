<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Enums\BookingStatus;
use App\Enums\RoomStatus;
use Carbon\Carbon;
use App\Models\Booking;
use App\Models\Room;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ReservationRepository
{
    /**
     * Paginate and filter bookings.
     *
     * @param array $data {
     *    @type string $user_id (optional)
     *    @type string $status (optional)
     *    @type string $start_date (optional)
     *    @type string $end_date (optional)
     *    @type string $search (optional)
     *    @type string $per_page (optional)
     * }
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate(array $data)
    {
        return Booking::query()
            ->when(get($data, 'user_id'), function ($query) use ($data) {
                $query->where('user_id', get($data, 'user_id'));
            })
            ->when(get($data, 'status'), function ($query) use ($data) {
                $query->where('status', get($data, 'status'));
            })
            ->when(get($data, 'start_date'), function ($query) use ($data) {
                $query->whereDate('created_at', '>=', Carbon::parse(get($data, 'start_date')));
            })
            ->when(get($data, 'end_date'), function ($query) use ($data) {
                $query->whereDate('created_at', '<=', Carbon::parse(get($data, 'end_date')));
            })
            ->when(get($data, 'search'), function ($query) use ($data) {
                $search = get($data, 'search');
                $query->where(function ($q) use ($search) {
                    $q->where('guest_name', 'like', "%{$search}%")
                        ->orWhere('guest_email', 'like', "%{$search}%")
                        ->orWhere('guest_phone', 'like', "%{$search}%")
                        ->orWhere('status', 'like', "%{$search}%");
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(get($data, 'per_page', 15));
    }

    /**
     * Find a booking by ID.
     *
     * @param string $bookingId
     * @return Booking|null
     */
    public function find(string $bookingId): ?Booking
    {
        return Booking::find($bookingId);
    }

    /**
     * Create a new booking.
     *
     * @param array $data {
     *    @type string $user_id
     *    @type string $room_id
     *    @type DateTime $check_in
     *    @type DateTime $check_out
     *    @type string $status
     *    @type string $guest_name
     *    @type string $guest_email
     *    @type string $guest_phone
     *    @type DateTime $from_date
     *    @type DateTime $to_date
     * }
     * @return Booking
     * @throws \Throwable
     */
    public function create(array $data): Booking
    {
        return DB::transaction(function () use ($data) {
            
            // Fetch and validate room
            $room = Room::lockForUpdate()->findOrFail($data['room_id']);

            if ($room->status !== RoomStatus::AVAILABLE) {
                throw ValidationException::withMessages([
                    'room_id' => ['Room is not available for booking.'],
                ]);
            }

            // Create booking
            $booking = Booking::create([
                ...$data,
                'user_id' => authUser()->id,
                'status' => BookingStatus::PENDING,
            ]);

            // Update room status
            $room->update([
                'status' => RoomStatus::BOOKED,
            ]);

            return $booking;
        });
    }

    /**
     * Update a booking.
     *
     * @param Booking $booking
     * @param array $data {
     *    @type string $user_id (optional)
     *    @type string $room_id (optional)
     *    @type DateTime $check_in (optional)
     *    @type DateTime $check_out (optional)
     *    @type string $status (optional)
     *    @type string $guest_name (optional)
     *    @type string $guest_email (optional)
     *    @type string $guest_phone (optional)
     *    @type DateTime $from_date (optional)
     *    @type DateTime $to_date (optional)
     * }
     * @return Booking
     */
    public function update(Booking $booking, array $data): Booking
    {
        $booking->update($data);
        return $booking;
    }

    /**
     * Soft-delete a booking.
     *
     * @param Booking $booking
     * @return void
     */
    public function destroy(Booking $booking): void
    {
        $booking->delete();
    }
}

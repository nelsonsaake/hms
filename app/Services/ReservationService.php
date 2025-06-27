<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Booking;
use App\Models\Room;
use App\Enums\BookingStatus; 
use Illuminate\Support\Carbon; 
use InvalidArgumentException;

class ReservationService
{
    /**
     * Check if the given room is available **right now**.
     *
     * @param Room|string $roomOrId  Room instance or ID
     * @return bool
     */
    public function checkAvailabilityNow(Room|string $roomOrId): bool
    {
        $roomId = $roomOrId instanceof Room ? $roomOrId->id : $roomOrId;
        $now = Carbon::now();

        return !Booking::query()
            ->where('room_id', $roomId)
            ->where('check_out', '>', $now)
            ->where('check_in', '<=', $now)
            ->whereNotIn('status', [BookingStatus::CANCELLED, BookingStatus::NO_SHOW, BookingStatus::REFUNDED])
            ->exists();
    }

    /**
     * Check a guest into their booking.
     *
     * @param Booking $booking
     * @throws InvalidArgumentException
     * @return void
     */
    public function checkIn(Booking $booking): void
    {
        if ($booking->status !== BookingStatus::CONFIRMED) {
            throw new InvalidArgumentException("Booking must be confirmed before check-in.");
        }

        $booking->update(['status' => BookingStatus::CHECKED_IN]);
    }

    /**
     * Check a guest out of their booking.
     *
     * @param Booking $booking
     * @throws InvalidArgumentException
     * @return void
     */
    public function checkOut(Booking $booking): void
    {
        if ($booking->status !== BookingStatus::CHECKED_IN) {
            throw new InvalidArgumentException("Booking must be checked-in before check-out.");
        }

        $booking->update(['status' => BookingStatus::CHECKED_OUT]);
    }

    /**
     * Get a list of valid next statuses for a booking, given its current status.
     *
     * @param string $current
     * @return string[]
     */
    public function getNextStatuses(string $current): array
    {
        return match ($current) {
            BookingStatus::PENDING     => [BookingStatus::CONFIRMED, BookingStatus::CANCELLED, BookingStatus::FAILED, BookingStatus::ON_HOLD],
            BookingStatus::CONFIRMED   => [BookingStatus::CHECKED_IN, BookingStatus::CANCELLED, BookingStatus::RESCHEDULED],
            BookingStatus::CHECKED_IN  => [BookingStatus::CHECKED_OUT],
            BookingStatus::RESCHEDULED => [BookingStatus::CONFIRMED],
            BookingStatus::ON_HOLD     => [BookingStatus::CONFIRMED, BookingStatus::CANCELLED],
            default                    => [],
        };
    }

    /**
     * Update the booking's status based on a string or array input.
     *
     * @param Booking $booking
     * @param string|array $statusOrPayload
     * @throws InvalidArgumentException
     * @return void
     */
    public function updateStatus(Booking $booking, string|array $statusOrPayload): void
    {
        $status = is_array($statusOrPayload) ? ($statusOrPayload['status'] ?? null) : $statusOrPayload;

        if (!in_array($status, BookingStatus::values(), true)) {
            throw new InvalidArgumentException("Invalid status provided.");
        }

        $booking->update(['status' => $status]);
    }
}

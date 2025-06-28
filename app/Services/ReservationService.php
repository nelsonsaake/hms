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

}

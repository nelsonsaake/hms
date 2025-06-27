<?php

namespace App\Policies;

use App\Enums\BookingStatus;
use App\Models\Booking;
use App\Models\User;

class ReservationPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if a booking can be modified.
     *
     * @param Booking $booking
     * @return bool
     */
    public static function canModify(Booking $booking): bool
    {
        $now = now();

        return !in_array($booking->status, [
            BookingStatus::CHECKED_IN,
            BookingStatus::CHECKED_OUT,
            BookingStatus::CANCELLED,
            BookingStatus::NO_SHOW,
            BookingStatus::REFUNDED,
            BookingStatus::FAILED,
        ]) &&
            $booking->check_in->isFuture();
    }
}

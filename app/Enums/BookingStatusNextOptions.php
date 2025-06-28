<?php

namespace App\Enums;

class BookingStatusNextOptions
{
    /**
     * Get next allowed statuses from a given current status.
     */
    public static function options(string $current): array
    {
        return match ($current) {
            BookingStatus::PENDING     => [
                BookingStatus::CONFIRMED,
                BookingStatus::CANCELLED,
                BookingStatus::FAILED,
                BookingStatus::ON_HOLD,
            ],
            BookingStatus::CONFIRMED   => [
                BookingStatus::CHECKED_IN,
                BookingStatus::CANCELLED,
                BookingStatus::NO_SHOW,
                BookingStatus::RESCHEDULED,
            ],
            BookingStatus::CHECKED_IN  => [
                BookingStatus::CHECKED_OUT,
            ],
            BookingStatus::RESCHEDULED => [
                BookingStatus::CONFIRMED,
            ],
            BookingStatus::ON_HOLD     => [
                BookingStatus::CONFIRMED,
                BookingStatus::CANCELLED,
            ],
            default => [],
        };
    }
}

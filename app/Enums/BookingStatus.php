<?php

namespace App\Enums;

class BookingStatus
{
    public const PENDING = 'pending'; 
    public const CONFIRMED = 'confirmed'; 
    public const CHECKED_IN = 'checked_in'; 
    public const CHECKED_OUT = 'checked_out'; 
    public const CANCELLED = 'cancelled'; 
    public const NO_SHOW = 'no_show'; 
    public const RESCHEDULED = 'rescheduled'; 
    public const FAILED = 'failed'; 
    public const ON_HOLD = 'on_hold'; 
    public const REFUNDED = 'refunded';

    /**
     * Get all roles as an array.
     */
    public static function values(): array
    {
        return [
            self::PENDING,
            self::CONFIRMED,
            self::CHECKED_IN,
            self::CHECKED_OUT,
            self::CANCELLED,
            self::NO_SHOW,
            self::RESCHEDULED,
            self::FAILED,
            self::ON_HOLD,
            self::REFUNDED,

        ];
    }
}


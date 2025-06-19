<?php

namespace App\Enums;

class RoomStatus
{
    public const AVAILABLE = 'available'; 
    public const BOOKED = 'booked'; 
    public const OUT_OF_SERVICE = 'out_of_service';

    /**
     * Get all roles as an array.
     */
    public static function values(): array
    {
        return [
            self::AVAILABLE,
            self::BOOKED,
            self::OUT_OF_SERVICE,

        ];
    }
}


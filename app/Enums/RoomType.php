<?php

namespace App\Enums;

class RoomType
{
    public const SINGLE = 'single'; 
    public const DOUBLE = 'double'; 
    public const TWIN = 'twin'; 
    public const TRIPLE = 'triple'; 
    public const SUITE = 'suite'; 
    public const FAMILY = 'family'; 
    public const DELUXE = 'deluxe'; 
    public const EXECUTIVE = 'executive'; 
    public const PENTHOUSE = 'penthouse'; 
    public const STUDIO = 'studio'; 
    public const BUNGALOW = 'bungalow'; 
    public const ACCESSIBLE = 'accessible';

    /**
     * Get all roles as an array.
     */
    public static function values(): array
    {
        return [
            self::SINGLE,
            self::DOUBLE,
            self::TWIN,
            self::TRIPLE,
            self::SUITE,
            self::FAMILY,
            self::DELUXE,
            self::EXECUTIVE,
            self::PENTHOUSE,
            self::STUDIO,
            self::BUNGALOW,
            self::ACCESSIBLE,

        ];
    }
}


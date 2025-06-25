<?php

namespace App\Enums;

class RoomPrice
{
    public static function value(string $type): float
    {
        return match ($type) {
            RoomType::SINGLE     => 80.00,
            RoomType::DOUBLE     => 100.00,
            RoomType::TWIN       => 110.00,
            RoomType::TRIPLE     => 130.00,
            RoomType::SUITE      => 200.00,
            RoomType::FAMILY     => 160.00,
            RoomType::DELUXE     => 180.00,
            RoomType::EXECUTIVE  => 220.00,
            RoomType::PENTHOUSE  => 400.00,
            RoomType::STUDIO     => 90.00,
            RoomType::BUNGALOW   => 250.00,
            RoomType::ACCESSIBLE => 100.00,
            default              => 0.00,
        };
    }

    public static function label(string $type): string
    {
        return mfmt(self::value($type), 2);
    }
}

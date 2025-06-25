<?php

namespace App\Enums;

class RoomBed
{
    public static function count(string $type): int
    {
        return match ($type) {
            RoomType::SINGLE     => 1,
            RoomType::DOUBLE     => 1,
            RoomType::TWIN       => 2,
            RoomType::TRIPLE     => 3,
            RoomType::SUITE      => 1,
            RoomType::FAMILY     => 3,
            RoomType::DELUXE     => 1,
            RoomType::EXECUTIVE  => 1,
            RoomType::PENTHOUSE  => 2,
            RoomType::STUDIO     => 1,
            RoomType::BUNGALOW   => 2,
            RoomType::ACCESSIBLE => 1,
            default              => 0,
        };
    }

    public static function label(string $type): string
    {
        return match (self::count($type)) {
            1 => '1 bed',
            2 => '2 beds',
            3 => '3 beds',
            default => 'No bed info',
        };
    }
}

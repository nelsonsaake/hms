<?php

namespace App\Enums;

class RoomDescription
{
    public static function short(string $type): string
    {
        return match ($type) {
            RoomType::SINGLE     => 'One bed, one guest',
            RoomType::DOUBLE     => 'One bed, two guests',
            RoomType::TWIN       => 'Two single beds',
            RoomType::TRIPLE     => 'Three guests',
            RoomType::SUITE      => 'Premium room with extra space',
            RoomType::FAMILY     => 'Multiple beds for families',
            RoomType::DELUXE     => 'Room with enhanced features',
            RoomType::EXECUTIVE  => 'Premium business-friendly room',
            RoomType::PENTHOUSE  => 'Luxury top-floor room',
            RoomType::STUDIO     => 'Compact room with kitchenette',
            RoomType::BUNGALOW   => 'Detached ground-level unit',
            RoomType::ACCESSIBLE => 'Wheelchair accessible room',
            default          => 'Unknown room type',
        };
    }

    public static function long(string $type): string
    {
        return match ($type) {
            RoomType::SINGLE     => 'A cozy room designed for one guest, featuring a single bed and all essential amenities.',
            RoomType::DOUBLE     => 'Perfect for couples or close companions, this room includes one large bed and a comfortable layout.',
            RoomType::TWIN       => 'Includes two separate single beds, ideal for friends or colleagues traveling together.',
            RoomType::TRIPLE     => 'Spacious enough for three guests, this room ensures comfort without compromise.',
            RoomType::SUITE      => 'A luxurious option offering a sleeping area and a separate living space for added relaxation.',
            RoomType::FAMILY     => 'Designed with families in mind, this room features multiple beds and ample space for group stays.',
            RoomType::DELUXE     => 'An upgraded room with enhanced décor, better views, and premium features.',
            RoomType::EXECUTIVE  => 'Tailored for business travelers, offering premium comfort and a work-friendly environment.',
            RoomType::PENTHOUSE  => 'Our most luxurious top-floor suite, offering the best views and ultimate comfort.',
            RoomType::STUDIO     => 'A compact and functional room with a kitchenette, ideal for short or extended stays.',
            RoomType::BUNGALOW   => 'Stand-alone, ground-level lodging with a private, home-like atmosphere.',
            RoomType::ACCESSIBLE => 'Designed for accessibility, this room supports wheelchair access and ADA-compliant features.',
            default          => 'No description available for this room type.',
        };
    }
}

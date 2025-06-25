<?php

namespace App\Enums;

class RoomType
{
    public const SINGLE     = 'single';
    public const DOUBLE     = 'double';
    public const TWIN       = 'twin';
    public const TRIPLE     = 'triple';
    public const SUITE      = 'suite';
    public const FAMILY     = 'family';
    public const DELUXE     = 'deluxe';
    public const EXECUTIVE  = 'executive';
    public const PENTHOUSE  = 'penthouse';
    public const STUDIO     = 'studio';
    public const BUNGALOW   = 'bungalow';
    public const ACCESSIBLE = 'accessible';

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

    public static function shortDescription(string $type): string
    {
        return match ($type) {
            self::SINGLE     => 'One bed, one guest',
            self::DOUBLE     => 'One bed, two guests',
            self::TWIN       => 'Two single beds',
            self::TRIPLE     => 'Three guests',
            self::SUITE      => 'Premium room with extra space',
            self::FAMILY     => 'Multiple beds for families',
            self::DELUXE     => 'Room with enhanced features',
            self::EXECUTIVE  => 'Premium business-friendly room',
            self::PENTHOUSE  => 'Luxury top-floor room',
            self::STUDIO     => 'Compact room with kitchenette',
            self::BUNGALOW   => 'Detached ground-level unit',
            self::ACCESSIBLE => 'Wheelchair accessible room',
            default          => 'Unknown room type',
        };
    }

    public static function longDescription(string $type): string
    {
        return match ($type) {
            self::SINGLE     => 'A cozy room designed for one guest, featuring a single bed and all essential amenities.',
            self::DOUBLE     => 'Perfect for couples or close companions, this room includes one large bed and a comfortable layout.',
            self::TWIN       => 'Includes two separate single beds, ideal for friends or colleagues traveling together.',
            self::TRIPLE     => 'Spacious enough for three guests, this room ensures comfort without compromise.',
            self::SUITE      => 'A luxurious option offering a sleeping area and a separate living space for added relaxation.',
            self::FAMILY     => 'Designed with families in mind, this room features multiple beds and ample space for group stays.',
            self::DELUXE     => 'An upgraded room with enhanced décor, better views, and premium features.',
            self::EXECUTIVE  => 'Tailored for business travelers, offering premium comfort and a work-friendly environment.',
            self::PENTHOUSE  => 'Our most luxurious top-floor suite, offering the best views and ultimate comfort.',
            self::STUDIO     => 'A compact and functional room with a kitchenette, ideal for short or extended stays.',
            self::BUNGALOW   => 'Stand-alone, ground-level lodging with a private, home-like atmosphere.',
            self::ACCESSIBLE => 'Designed for accessibility, this room supports wheelchair access and ADA-compliant features.',
            default          => 'No description available for this room type.',
        };
    }
}

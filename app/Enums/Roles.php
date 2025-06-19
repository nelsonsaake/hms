<?php

namespace App\Enums;

class Roles
{
    public const ADMINISTRATOR = 'administrator';
    public const USER = 'user';

    /**
     * Get all roles as an array.
     */
    public static function values(): array
    {
        return [
            self::ADMINISTRATOR,
            self::USER,
        ];
    }
}

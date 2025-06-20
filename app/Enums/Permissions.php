<?php

declare(strict_types=1);

namespace App\Enums;

class Permissions
{
    // BOOKING PERMISSIONS
    public const VIEW_ANY_BOOKING = 'view_any_booking';
    public const VIEW_BOOKING = 'view_booking';
    public const CREATE_BOOKING = 'create_booking';
    public const UPDATE_BOOKING = 'update_booking';
    public const DELETE_BOOKING = 'delete_booking';
    public const RESTORE_BOOKING = 'restore_booking';
    public const FORCE_DELETE_BOOKING = 'force_delete_booking';

    // ROOM IMAGE PERMISSIONS
    public const VIEW_ANY_ROOM_IMAGE = 'view_any_room_image';
    public const VIEW_ROOM_IMAGE = 'view_room_image';
    public const CREATE_ROOM_IMAGE = 'create_room_image';
    public const UPDATE_ROOM_IMAGE = 'update_room_image';
    public const DELETE_ROOM_IMAGE = 'delete_room_image';
    public const RESTORE_ROOM_IMAGE = 'restore_room_image';
    public const FORCE_DELETE_ROOM_IMAGE = 'force_delete_room_image';

    // ROOM PERMISSIONS
    public const VIEW_ANY_ROOM = 'view_any_room';
    public const VIEW_ROOM = 'view_room';
    public const CREATE_ROOM = 'create_room';
    public const UPDATE_ROOM = 'update_room';
    public const DELETE_ROOM = 'delete_room';
    public const RESTORE_ROOM = 'restore_room';
    public const FORCE_DELETE_ROOM = 'force_delete_room';

    // USER PERMISSIONS
    public const VIEW_ANY_USER = 'view_any_user';
    public const VIEW_USER = 'view_user';
    public const CREATE_USER = 'create_user';
    public const UPDATE_USER = 'update_user';
    public const DELETE_USER = 'delete_user';
    public const RESTORE_USER = 'restore_user';
    public const FORCE_DELETE_USER = 'force_delete_user';


    /**
     * Get all permissions as an array.
     */
    public static function values(): array
    {
        return [
        
            // BOOKING PERMISSIONS
            self::VIEW_ANY_BOOKING,
            self::VIEW_BOOKING,
            self::CREATE_BOOKING,
            self::UPDATE_BOOKING,
            self::DELETE_BOOKING,
            self::RESTORE_BOOKING,
            self::FORCE_DELETE_BOOKING,
        
            // ROOM IMAGE PERMISSIONS
            self::VIEW_ANY_ROOM_IMAGE,
            self::VIEW_ROOM_IMAGE,
            self::CREATE_ROOM_IMAGE,
            self::UPDATE_ROOM_IMAGE,
            self::DELETE_ROOM_IMAGE,
            self::RESTORE_ROOM_IMAGE,
            self::FORCE_DELETE_ROOM_IMAGE,
        
            // ROOM PERMISSIONS
            self::VIEW_ANY_ROOM,
            self::VIEW_ROOM,
            self::CREATE_ROOM,
            self::UPDATE_ROOM,
            self::DELETE_ROOM,
            self::RESTORE_ROOM,
            self::FORCE_DELETE_ROOM,
        
            // USER PERMISSIONS
            self::VIEW_ANY_USER,
            self::VIEW_USER,
            self::CREATE_USER,
            self::UPDATE_USER,
            self::DELETE_USER,
            self::RESTORE_USER,
            self::FORCE_DELETE_USER,
        
        ];
    }
} 


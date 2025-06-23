<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;use Illuminate\Support\Str;

class Booking extends Model
{
    use HasFactory;

    // Disable auto-incrementing
    public $incrementing = false;

    // Specify the key type as string (UUID)
    protected $keyType = 'string';

    // Specify the name of the primary key field
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'room_id',
        'check_in',
        'check_out',
        'status',
        'guest_name',
        'guest_email',
        'guest_phone',
    ];

    protected $append = [
    ];

    protected static function boot()
    {
        parent::boot();

        // Automatically generate UUID when creating a new Booking
        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class, 'room_id', 'id');
    }

}


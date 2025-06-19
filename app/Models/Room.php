<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;use Illuminate\Support\Str;

class Room extends Model
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
        'type',
        'price',
        'beds',
        'description',
        'status',
    ];

    protected $casts = [
        'price' => 'double',
        'beds' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        // Automatically generate UUID when creating a new Room
        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class, 'room_id', 'id');
    }

    public function roomImages(): HasMany
    {
        return $this->hasMany(RoomImage::class, 'room_id', 'id');
    }

}


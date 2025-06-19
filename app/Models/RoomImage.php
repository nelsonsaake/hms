<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;use Illuminate\Support\Str;

class RoomImage extends Model
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
        'path',
        'room_id',
    ];

    protected static function boot()
    {
        parent::boot();

        // Automatically generate UUID when creating a new RoomImage
        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class, 'room_id', 'id');
    }

}


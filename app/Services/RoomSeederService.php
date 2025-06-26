<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\RoomBed;
use App\Enums\RoomDescription;
use App\Enums\RoomPrice;
use App\Enums\RoomType;
use App\Models\Room;
use App\Models\RoomImage;

class RoomSeederService
{
    public function run()
    {
        foreach (Room::all() as $room){
            $room->update([ 
                'description' => RoomDescription::long($room->type),
                'beds' => RoomBed::count($room->type),
                'price' => RoomPrice::value($room->type),
            ]);
        }

        foreach (RoomType::values() as $roomType) {
            Room::factory()->create([
                'type' => $roomType,
                'description' => RoomDescription::long($roomType),
                'beds' => RoomBed::count($roomType),
                'price' => RoomPrice::value($roomType),
            ]);
        }
    }
}

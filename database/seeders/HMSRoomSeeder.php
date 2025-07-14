<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\RoomBed;
use App\Enums\RoomDescription;
use App\Enums\RoomPrice;
use App\Enums\RoomType;
use App\Models\Room;
use App\Models\RoomImage;
use Illuminate\Database\Seeder;

class HMSRoomSeeder extends Seeder
{
    public function run()
    {
        foreach (Room::all() as $room) {
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

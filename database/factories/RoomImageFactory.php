<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash; 
use App\Models\Room;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RoomImage>
 */
class RoomImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'path' => 'uploads/' . fake()->uuid() . '.pdf',
            'room_id' => Room::inRandomOrder()->value('id') ?? Room::factory(),
        ];
    }
}


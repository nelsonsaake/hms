<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash; 
use App\Enums\RoomType;use App\Enums\RoomStatus;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => fake()->randomElement(RoomType::values()),
            'price' => fake()->randomFloat(2, 1, 1000),
            'beds' => fake()->numberBetween(1, 1000),
            'description' => fake()->sentence(),
            'status' => fake()->randomElement(RoomStatus::values()),
        ];
    }
}


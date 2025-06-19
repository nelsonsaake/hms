<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash; 
use App\Models\User;
use App\Models\Room;
use App\Enums\BookingStatus;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->value('id') ?? User::factory(),
            'room_id' => Room::inRandomOrder()->value('id') ?? Room::factory(),
            'check_in' => fake()->dateTime(),
            'check_out' => fake()->dateTime(),
            'status' => fake()->randomElement(BookingStatus::values()),
            'guest_name' => fake()->name(),
            'guest_email' => fake()->unique()->safeEmail(),
            'guest_phone' => fake()->phoneNumber(),
        ];
    }
}


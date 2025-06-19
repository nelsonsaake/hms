<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // add 10 Booking to db
        for ($i = 0; $i < 10; $i++) {
            try {
                \App\Models\Booking::factory()->create();
            } catch (\Throwable $e) {
                // Log the error message to the console
                echo "Error: " . $e->getMessage() . PHP_EOL;
            }
        }

    }
}


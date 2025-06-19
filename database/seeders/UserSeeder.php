<?php

namespace Database\Seeders;

use App\Enums\Roles;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminEmail = 'admin@example.com';
        $userEmail = 'user@example.com';

        $admin = User::where('email', $adminEmail)->first();
        $user = User::where('email', $userEmail)->first();

        // Admin user - created with factory if doesn't exist
        if (!$admin) {
            $admin = User::factory()->create([
                'email' => $adminEmail,
                'name' => 'Test Admin',
            ]);
        }

        // Regular user - created with factory if doesn't exist
        if (!$user) {
            $user = User::factory()->create([
                'email' => $userEmail,
                'name' => 'Test User',
            ]);
        }

        $admin->assignRole(Roles::ADMINISTRATOR);
        $user->assignRole(Roles::USER);

        // Create additional test users if needed
        User::factory(10)->create()->each(function ($user) {
            $user->assignRole(Roles::USER);
        });
    }
}

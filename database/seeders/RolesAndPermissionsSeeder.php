<?php

namespace Database\Seeders;

use App\Enums\Permissions;
use App\Enums\Roles;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Create Permissions
        foreach (Permissions::values() as $permission) {
            Permission::firstOrCreate(attributes: ['name' => $permission]);
        }

        // Create Roles
        foreach (Roles::values() as $role) {
            Role::firstOrCreate(attributes: ['name' => $role]);
        }
    }
}

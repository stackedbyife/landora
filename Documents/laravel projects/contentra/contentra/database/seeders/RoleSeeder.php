<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
            // Roles
    Role::create(['name' => 'Admin']);
    Role::create(['name' => 'Editor']);
    Role::create(['name' => 'User']);
    Role::create(['name' => 'Moderator']); // bonus

    // Permissions 
    Permission::create(['name' => 'manage posts']);
    Permission::create(['name' => 'manage videos']);
    Permission::create(['name' => 'manage comments']);
    Permission::create(['name' => 'assign roles']);

    Role::findByName('Admin')->givePermissionTo(Permission::all());
    Role::findByName('Editor')->givePermissionTo(['manage posts', 'manage videos', 'manage comments']);
    Role::findByName('Moderator')->givePermissionTo(['manage comments']);
    }
}

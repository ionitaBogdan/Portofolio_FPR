<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Manager Role
        $managerRole = Role::create(['name' => 'manager']);

        // Create Worker Role
        $workerRole = Role::create(['name' => 'worker']);

        // Create Admin Role
        $adminRole = Role::create(['name' => 'admin']);

        // Create Manager User
        $managerUser = User::create([
            'name' => 'Example Manager',
            'email' => 'manager@example.com',
            'password' => bcrypt('password'),
        ]);
        $managerUser->assignRole($managerRole);

        // Create Worker User
        $workerUser = User::create([
            'name' => 'Worker User',
            'email' => 'worker@example.com',
            'password' => bcrypt('password'),
        ]);
        $workerUser->assignRole($workerRole);

        // Create Admin User
        $adminUser = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);
        $adminUser->assignRole($adminRole);

        // Create Another Manager User
        $anotherManagerUser = User::create([
            'name' => 'Another Manager',
            'email' => 'another_manager@example.com',
            'password' => bcrypt('password'),
        ]);
        $anotherManagerUser->assignRole($managerRole);
    }
}

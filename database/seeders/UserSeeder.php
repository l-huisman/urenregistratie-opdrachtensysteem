<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create an administrator
        $adminRole = Role::where('slug', 'administrator')->first();
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // Change as needed
        ])->roles()->attach($adminRole);

        // Create a manager
        $managerRole = Role::where('slug', 'manager')->first();
        User::factory()->create([
            'name' => 'Manager User',
            'email' => 'manager@example.com',
            'password' => Hash::make('password'),
        ])->roles()->attach($managerRole);

        // Create a regular user
        $gebruikerRole = Role::where('slug', 'gebruiker')->first();
        User::factory()->count(5)->create()->each(function ($user) use ($gebruikerRole) {
            $user->roles()->attach($gebruikerRole);
        });

        // Create a client user
        $klantRole = Role::where('slug', 'klant')->first();
        User::factory()->count(3)->create()->each(function ($user) use ($klantRole) {
            $user->roles()->attach($klantRole);
        });
    }
}

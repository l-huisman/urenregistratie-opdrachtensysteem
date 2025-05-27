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
        $adminRole = Role::where('slug', 'administrator')->first();
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@smit.net',
            'password' => Hash::make('password'),
            'role_id' => $adminRole->id,
        ]);

        $managerRole = Role::where('slug', 'manager')->first();
        User::factory()->create([
            'name' => 'Manager',
            'email' => 'manager@smit.net',
            'password' => Hash::make('password'),
            'role_id' => $managerRole->id,
        ]);

        $gebruikerRole = Role::where('slug', 'gebruiker')->first();
        User::factory()->create([
            'name' => 'Gebruiker',
            'email' => 'gebruiker@smit.net',
            'password' => Hash::make('password'),
            'role_id' => $gebruikerRole->id,
        ]);

        $klantRole = Role::where('slug', 'klant')->first();
        User::factory()->create([
            'name' => 'Klant',
            'email' => 'klant@smit.net',
            'password' => Hash::make('password'),
            'role_id' => $klantRole->id,
        ]);
    }
}

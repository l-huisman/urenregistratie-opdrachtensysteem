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

        $gebruikerRole = Role::where('slug', 'user')->first();
        User::factory()->create([
            'name' => 'user',
            'email' => 'gebruiker@smit.net',
            'password' => Hash::make('password'),
            'role_id' => $gebruikerRole->id,
        ]);

        $klantRole = Role::where('slug', 'client')->first();
        User::factory()->create([
            'name' => 'client',
            'email' => 'klant@smit.net',
            'password' => Hash::make('password'),
            'role_id' => $klantRole->id,
        ]);
    }
}

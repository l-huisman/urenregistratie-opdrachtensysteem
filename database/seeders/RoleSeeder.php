<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['klant', 'gebruiker', 'manager'];

        foreach ($roles as $roleName) {
            Role::firstOrCreate([
                'slug' => Str::slug($roleName),
            ], [
                'name' => ucfirst($roleName),
            ]);
        }
    }
}

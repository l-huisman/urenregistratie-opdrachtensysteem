<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            ClientSeeder::class,
            CompanySeeder::class,
            PriceAgreementSeeder::class,
            ProjectSeeder::class,
            PhaseSeeder::class,
            TaskSeeder::class,
            WorkedTimeSeeder::class,
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\WorkedTime;
use Illuminate\Database\Seeder;

class WorkedTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WorkedTime::factory()
            ->count(100)
            ->create();
    }
}

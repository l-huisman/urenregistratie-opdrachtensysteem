<?php

namespace Database\Seeders;

use App\Models\Phase;
use Illuminate\Database\Seeder;

class PhaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Phase::factory()->create(
            [
                'project_id' => 1,
                'name' => 'Fase 1',
                'description' => 'De eerste fase van het project.',
            ]
        );
    }
}

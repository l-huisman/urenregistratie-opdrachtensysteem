<?php

namespace Database\Seeders;

use App\Enums\Status;
use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::factory()->create(
            [
                'name' => 'Gripp Clone',
                'description' => 'Een urenregistratie systeem waarin medewerkers hun uren kunnen registreren en klanten hun projecten kunnen beheren.',
                'status' => Status::PLANNED,
                'start_date' => now(),
                'end_date' => now()->addDays(30),
                'company_id' => 1,
            ]
        );
    }
}

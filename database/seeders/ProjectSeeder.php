<?php

namespace Database\Seeders;

use App\Enums\ProjectType;
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
                'type' => ProjectType::BUNDLE,
                'company_id' => 1,
            ]
        );
    }
}

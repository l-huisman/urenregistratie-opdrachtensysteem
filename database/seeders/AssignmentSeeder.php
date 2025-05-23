<?php

namespace Database\Seeders;

use App\Models\Assignment;
use App\Models\Company;
use Illuminate\Database\Seeder;

class AssignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = Company::all();

        if ($companies->isEmpty()) {
            $this->command->info('No companies found for assignments. Please seed companies first.');
            return;
        }

        foreach ($companies as $company) {
            Assignment::factory()->count(rand(1, 5))->create([
                'company_id' => $company->id,
            ]);
        }
    }
}

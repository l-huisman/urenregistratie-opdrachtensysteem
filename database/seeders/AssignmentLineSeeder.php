<?php

namespace Database\Seeders;

use App\Models\Assignment;
use App\Models\AssignmentLine;
use Illuminate\Database\Seeder;

class AssignmentLineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $assignments = Assignment::all();

        if ($assignments->isEmpty()) {
            $this->command->info('No assignments found for assignment lines. Please seed assignments first.');
            return;
        }

        foreach ($assignments as $assignment) {
            AssignmentLine::factory()->count(rand(2, 7))->create([
                'assignment_id' => $assignment->id,
            ]);
        }
    }
}

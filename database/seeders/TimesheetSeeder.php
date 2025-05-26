<?php

namespace Database\Seeders;

use App\Models\Assignment;
use App\Models\Timesheet;
use App\Models\User;
use Illuminate\Database\Seeder;

class TimesheetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $assignments = Assignment::all();
        $users = User::whereDoesntHave('role', function ($query) {
            $query->where('slug', 'klant');
        })->get();


        if ($assignments->isEmpty() || $users->isEmpty()) {
            $this->command->info('No assignments or eligible users found for timesheets. Please seed them first.');
            return;
        }

        foreach ($assignments as $assignment) {
            Timesheet::factory()->count(rand(5, 15))->create([
                'assignment_id' => $assignment->id,
                'user_id' => $users->random()->id,
            ]);
        }
    }
}

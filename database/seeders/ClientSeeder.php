<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = Company::all();

        if ($companies->isEmpty()) {
            $this->command->info('No companies found, creating some first...');
            Company::factory()->count(5)->create();
            $companies = Company::all();
        }

        $users = User::where('role_id', 1)->get();
        $clients = [];

        foreach ($users as $user) {
            $client = Client::factory()->create([
                'user_id' => $user->id,
            ]);
            $clients[] = $client;
        }


        foreach ($clients as $client) {
            $company = $companies->random();
            $client->companies()->attach($company->id);
        }
    }
}

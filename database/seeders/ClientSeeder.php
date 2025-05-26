<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Client;
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

        foreach ($companies as $company) {
            $clients = Client::factory()->count(rand(1, 3))->create();

            foreach ($clients as $client) {
                $client->companies()->attach($company->id);
            }
        }
    }
}

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
        $company = Company::factory()->create([
            'name' => 'Smit',
            'address' => 'Rijksweg 86, 1906 BK Limmen',
            'phone_number' => '0884470000',
            'email' => 'contact@smit.net',
            'website' => 'https://www.smit.net',
            'kvk_number' => '34246947',
            'logo' => '/logos/smit.jpg',
        ]);

        /* @var User $user */
        $user = User::query()->firstWhere('role_id', 1);

        /** @var Client $client */
        $client = Client::factory()->create([
            'user_id' => $user->id,
        ]);

        $client->companies()->attach($company->id);
    }
}

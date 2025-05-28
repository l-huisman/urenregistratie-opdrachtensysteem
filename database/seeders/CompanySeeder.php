<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::factory()->count(1)->create([
            'name' => 'Smit',
            'address' => 'Rijksweg 86, 1906 BK Limmen',
            'phone_number' => '0884470000',
            'email' => 'contact@smit.net',
            'website' => 'https://www.smit.net',
            'kvk_number' => '34246947',
            'logo' => '/logos/smit.jpg',
        ]);
        Company::factory()->count(9)->create();
    }
}

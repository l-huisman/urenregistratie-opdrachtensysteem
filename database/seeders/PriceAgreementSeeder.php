<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\PriceAgreement;
use Illuminate\Database\Seeder;

class PriceAgreementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = Company::all();

        if ($companies->isEmpty()) {
            $this->command->info('No companies found for price agreements. Please seed companies first.');
            return;
        }

        foreach ($companies as $company) {
            PriceAgreement::factory()->count(rand(0, 2))->create([ // Some companies might not have specific agreements
                'company_id' => $company->id,
            ]);
        }
    }
}

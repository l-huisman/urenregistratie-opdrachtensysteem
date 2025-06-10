<?php

namespace Tests\Unit\Policies;

use App\Filament\Resources\CompanyResource\Pages\EditCompany;
use App\Models\Client;
use App\Models\Company;
use App\Models\User;
use Database\Factories\CompanyFactory;
use Database\Factories\UserFactory;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CompanyPolicyTest extends TestCase
{
    use RefreshDatabase;

    protected Client $client;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(DatabaseSeeder::class);
        $clientUser = User::factory()->create(['role_id' => 1]);
        $this->client = Client::factory()->create(['user_id' => $clientUser->id]);
        $company = Company::factory()->create();
        $company->clients()->attach($this->client->id);
    }

    #[Test]
    public function clients_can_only_edit_their_own_companies()
    {
        $user = UserFactory::new()->client()->create();

        $ownCompany = CompanyFactory::new()->hasAttached($user->client, relationship: 'clients')->create();
        $otherCompany = CompanyFactory::new()->create();

        $this->actingAs($user);

        $this->get(EditCompany::getUrl(['record' => $ownCompany]))->assertOk();

        $this->get(EditCompany::getUrl(['record' => $otherCompany]))->assertForbidden();
    }
}

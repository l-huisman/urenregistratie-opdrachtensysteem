<?php

namespace Tests\Unit\Policies;

use App\Filament\Resources\CompanyResource\Pages\EditCompany;
use App\Models\Client;
use App\Models\Company;
use App\Models\User;
use Database\Factories\ClientFactory;
use Database\Factories\CompanyFactory;
use Database\Factories\UserFactory;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CompanyPolicyTest extends TestCase
{
    use RefreshDatabase;

    protected User $administrator;
    protected User $manager;
    protected User $user;
    protected Company $company;
    protected Company $otherCompany;
    protected Client $client;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(DatabaseSeeder::class);
//        $this->artisan('migrate:fresh', ['--seed' => true]);
        $this->administrator = User::factory()->create(['role_id' => 4]);
        $this->manager = User::factory()->create(['role_id' => 3]);
        $this->user = User::factory()->create(['role_id' => 2]);
        $clientUser = User::factory()->create(['role_id' => 1]);
        $this->client = Client::factory()->create(['user_id' => $clientUser->id]);
        $this->company = Company::factory()->create();
        $this->otherCompany = Company::factory()->create();

        $this->company->clients()->attach($this->client->id);
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

//        Livewire::actingAs($user);
//        Livewire::test(EditCompany::class, [$ownCompany])->assertOk();
    }



    public function test_administrator_can_view_any_company(): void
    {
        $this->assertTrue($this->administrator->can('viewAny', Company::class));
    }

    public function test_administrator_can_view_company(): void
    {
        $this->assertTrue($this->administrator->can('view', $this->company));
    }

    public function test_administrator_can_create_company(): void
    {
        $this->assertTrue($this->administrator->can('create', Company::class));
    }

    public function test_administrator_can_update_company(): void
    {
        $this->assertTrue($this->administrator->can('update', $this->company));
    }

    public function test_administrator_can_delete_company(): void
    {
        $this->assertTrue($this->administrator->can('delete', $this->company));
    }

    public function test_administrator_can_restore_company(): void
    {
        $this->assertTrue($this->administrator->can('restore', $this->company));
    }

    public function test_administrator_cannot_force_delete_company(): void
    {
        $this->assertFalse($this->administrator->can('forceDelete', $this->company));
    }

    public function test_manager_can_view_any_company(): void
    {
        $this->assertTrue($this->manager->can('viewAny', Company::class));
    }

    public function test_manager_can_view_company(): void
    {
        $this->assertTrue($this->manager->can('view', $this->company));
    }

    public function test_manager_can_create_company(): void
    {
        $this->assertTrue($this->manager->can('create', Company::class));
    }

    public function test_manager_can_update_company(): void
    {
        $this->assertTrue($this->manager->can('update', $this->company));
    }

    public function test_manager_cannot_delete_company(): void
    {
        $this->assertFalse($this->manager->can('delete', $this->company));
    }

    public function test_manager_cannot_restore_company(): void
    {
        $this->assertFalse($this->manager->can('restore', $this->company));
    }

    public function test_manager_cannot_force_delete_company(): void
    {
        $this->assertFalse($this->manager->can('forceDelete', $this->company));
    }

    public function test_user_cannot_view_any_company(): void
    {


        $this->assertFalse($this->user->can('viewAny', Company::class));
    }

    public function test_user_cannot_view_company(): void
    {
        $this->assertFalse($this->user->can('view', $this->company));
    }

    public function test_user_cannot_create_company(): void
    {
        $this->assertFalse($this->user->can('create', Company::class));
    }

    public function test_user_cannot_update_company(): void
    {
        $this->assertFalse($this->user->can('update', $this->company));
    }

    public function test_user_cannot_delete_company(): void
    {
        $this->assertFalse($this->user->can('delete', $this->company));
    }

    public function test_user_cannot_restore_company(): void
    {
        $this->assertFalse($this->user->can('restore', $this->company));
    }

    public function test_user_cannot_force_delete_company(): void
    {
        $this->assertFalse($this->user->can('forceDelete', $this->company));
    }

    public function test_client_cannot_view_any_company(): void
    {
        $this->assertFalse($this->client->user->can('viewAny', Company::class));
    }

    public function test_client_can_view_company(): void
    {
        $this->assertTrue($this->client->user->can('view', $this->company));
    }

    public function test_client_can_create_company(): void
    {
        $this->assertTrue($this->client->user->can('create', Company::class));
    }

    public function test_client_can_update_company(): void
    {
        $this->assertTrue($this->client->user->can('update', $this->company));
    }

    public function test_client_cannot_delete_company(): void
    {
        $this->assertFalse($this->client->user->can('delete', $this->company));
    }

    public function test_client_cannot_restore_company(): void
    {
        $this->assertFalse($this->client->user->can('restore', $this->company));
    }

    public function test_client_cannot_force_delete_company(): void
    {
        $this->assertFalse($this->client->user->can('forceDelete', $this->company));
    }

    public function test_client_cannot_view_other_company(): void
    {
        $this->assertFalse($this->client->user->can('view', $this->otherCompany));
    }

    public function test_client_cannot_update_other_company(): void
    {
        // given a user does not belong to a company


        // when the user updates the company
        // then the update is rejected

        $this->assertFalse($this->client->user->can('update', $this->otherCompany));
    }

    public function test_client_cannot_delete_other_company(): void
    {
        $this->assertFalse($this->client->user->can('delete', $this->otherCompany));
    }

    public function test_client_cannot_restore_other_company(): void
    {
        $this->assertFalse($this->client->user->can('restore', $this->otherCompany));
    }

    public function test_client_cannot_force_delete_other_company(): void
    {
        $this->assertFalse($this->client->user->can('forceDelete', $this->otherCompany));
    }
}

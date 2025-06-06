<?php

namespace Tests\Unit\Policies;

use App\Models\Client;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClientPolicyTest extends TestCase
{
    use RefreshDatabase;

    protected User $administrator;
    protected User $manager;
    protected User $clientUser;
    protected User $otherUser;
    protected Client $client;
    protected Client $testClient;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate:fresh', ['--seed' => true]);
        $this->administrator = User::factory()->create(['role_id' => 4]);
        $this->manager = User::factory()->create(['role_id' => 3]);
        $this->clientUser = User::factory()->create(['role_id' => 1]);
        $this->otherUser = User::factory()->create(['role_id' => 1]);
        $this->client = Client::factory()->create(['user_id' => $this->clientUser->id]);
        $this->testClient = Client::factory()->create(['user_id' => $this->otherUser->id]);
    }

    public function test_admin_can_view_any_client()
    {
        $this->assertTrue($this->administrator->can('viewAny', Client::class));
    }

    public function test_manager_can_view_any_client()
    {
        $this->assertTrue($this->manager->can('viewAny', Client::class));
    }

    public function test_client_cannot_view_any_client()
    {
        $this->assertFalse($this->clientUser->can('viewAny', Client::class));
    }

    public function test_admin_can_view_client()
    {
        $this->assertTrue($this->administrator->can('view', $this->client));
    }

    public function test_manager_can_view_client()
    {
        $this->assertTrue($this->manager->can('view', $this->client));
    }

    public function test_client_can_view_self()
    {
        $this->assertTrue($this->clientUser->can('view', $this->client));
    }

    public function test_client_cannot_view_other_client()
    {
        $this->assertFalse($this->clientUser->can('view', $this->testClient));
    }

    public function test_admin_can_create_client()
    {
        $this->assertTrue($this->administrator->can('create', Client::class));
    }

    public function test_manager_can_create_client()
    {
        $this->assertTrue($this->manager->can('create', Client::class));
    }

    public function test_client_cannot_create_client()
    {
        $this->assertFalse($this->clientUser->can('create', Client::class));
    }

    public function test_admin_can_update_client()
    {
        $this->assertTrue($this->administrator->can('update', $this->client));
    }

    public function test_manager_can_update_client()
    {
        $this->assertTrue($this->manager->can('update', $this->client));
    }

    public function test_client_can_update_self()
    {
        $this->assertTrue($this->clientUser->can('update', $this->client));
    }

    public function test_client_cannot_update_other_client()
    {
        $this->assertFalse($this->clientUser->can('update', $this->testClient));
    }

    public function test_admin_can_delete_client()
    {
        $this->assertTrue($this->administrator->can('delete', $this->client));
    }

    public function test_manager_cannot_delete_client()
    {
        $this->assertFalse($this->manager->can('delete', $this->client));
    }

    public function test_client_cannot_delete_self()
    {
        $this->assertFalse($this->clientUser->can('delete', $this->client));
    }

    public function test_admin_can_restore_client()
    {
        $this->assertTrue($this->administrator->can('restore', $this->client));
    }

    public function test_manager_cannot_restore_client()
    {
        $this->assertFalse($this->manager->can('restore', $this->client));
    }

    public function test_client_cannot_restore_self()
    {
        $this->assertFalse($this->clientUser->can('restore', $this->client));
    }

    public function test_no_one_can_force_delete_client()
    {
        $this->assertFalse($this->administrator->can('forceDelete', $this->client));
        $this->assertFalse($this->manager->can('forceDelete', $this->client));
        $this->assertFalse($this->clientUser->can('forceDelete', $this->client));
    }
}

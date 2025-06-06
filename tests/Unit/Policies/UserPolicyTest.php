<?php

namespace Tests\Unit\Policies;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserPolicyTest extends TestCase
{
    use RefreshDatabase;

    protected User $administrator;
    protected User $manager;
    protected User $user;
    protected User $client;
    protected User $testUser;

    protected function setUp(): void
    {
        parent::setUp();

        // Run migrations and seed the database
        $this->artisan('migrate:fresh', ['--seed' => true]);


        // Grab the roles from the database by role\_id
        $this->administrator = User::where('role_id', 4)->first();
        $this->manager = User::where('role_id', 3)->first();
        $this->user = User::where('role_id', 2)->first();
        $this->client = User::where('role_id', 1)->first();

        $this->testUser = User::factory()->create(['role_id' => 1]);
    }

    public function test_admin_can_view_any_user()
    {
        $this->assertTrue($this->administrator->can('viewAny', User::class));
    }

    public function test_admin_can_update_any_user()
    {
        $this->assertTrue($this->administrator->can('update', $this->testUser));
    }

    public function test_admin_can_delete_any_user()
    {
        $this->assertTrue($this->administrator->can('delete', $this->testUser));
    }

    public function test_admin_can_restore_any_user()
    {
        $this->assertTrue($this->administrator->can('restore', $this->testUser));
    }

    public function test_manager_can_view_any_user()
    {
        $this->assertTrue($this->manager->can('viewAny', User::class));
    }

    public function test_manager_can_update_any_user()
    {
        $this->assertTrue($this->manager->can('update', $this->testUser));
    }

    public function test_manager_can_delete_any_user()
    {
        $this->assertTrue($this->manager->can('delete', $this->testUser));
    }

    public function test_manager_cannot_restore_any_user()
    {
        $this->assertFalse($this->manager->can('restore', $this->testUser));
    }

    public function test_user_can_view_self()
    {
        $this->assertTrue($this->user->can('view', $this->user));
    }

    public function test_user_can_update_self()
    {
        $this->assertTrue($this->user->can('update', $this->user));
    }

    public function test_user_cannot_view_other_user()
    {
        $otherUser = User::factory()->create(['role_id' => 1]);
        $this->assertFalse($this->user->can('view', $otherUser));
    }

    public function test_user_cannot_update_other_user()
    {
        $otherUser = User::factory()->create(['role_id' => 1]);
        $this->assertFalse($this->user->can('update', $otherUser));
    }

    public function test_user_cannot_delete_self_or_others()
    {
        $this->assertFalse($this->user->can('delete', $this->user));

        $otherUser = User::factory()->create(['role_id' => 1]);
        $this->assertFalse($this->user->can('delete', $otherUser));
    }

    public function test_other_user_cannot_view_update_delete_or_restore_user()
    {
        $this->assertFalse($this->client->can('viewAny', User::class));
        $this->assertFalse($this->client->can('update', $this->testUser));
        $this->assertFalse($this->client->can('delete', $this->testUser));
        $this->assertFalse($this->client->can('restore', $this->testUser));
    }
}

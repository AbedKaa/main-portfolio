<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_are_redirected_to_login(): void
    {
        $this->get('/admin')->assertRedirect('/login');
        $this->post('/admin/projects', ['title' => 'x'])->assertRedirect('/login');
    }

    public function test_non_admin_users_are_forbidden(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->get('/admin')->assertForbidden();
        $this->actingAs($user)->get('/admin/settings')->assertForbidden();
    }

    public function test_admin_can_open_every_admin_page(): void
    {
        $admin = User::factory()->create();
        $admin->forceFill(['is_admin' => true])->save();

        foreach (['/admin', '/admin/settings', '/admin/projects', '/admin/skills', '/admin/experiences',
            '/admin/certificates', '/admin/posts', '/admin/messages'] as $uri) {
            $this->actingAs($admin)->get($uri)->assertOk();
        }
    }

    public function test_is_admin_cannot_be_mass_assigned(): void
    {
        $user = User::create(['name' => 'x', 'email' => 'x@example.com', 'password' => 'secret-password', 'is_admin' => true]);

        $this->assertFalse((bool) $user->fresh()->is_admin);
    }

    public function test_create_admin_command(): void
    {
        $this->artisan('app:create-admin', ['--email' => 'Me@Example.com', '--name' => 'Me'])
            ->expectsQuestion('Password (min 12 characters)', 'a-long-password-123')
            ->expectsQuestion('Confirm password', 'a-long-password-123')
            ->assertSuccessful();

        $this->assertTrue((bool) User::where('email', 'me@example.com')->value('is_admin'));
    }

    public function test_seeder_does_not_create_users(): void
    {
        $this->seed();

        $this->assertSame(0, User::count());
        $this->assertDatabaseHas('site_settings', ['id' => 1]);
    }
}

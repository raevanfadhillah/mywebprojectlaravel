<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthRoleTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_assigns_the_default_user_role(): void
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'user@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertRedirect('/login');
        $this->assertDatabaseHas('users', [
            'email' => 'user@example.com',
            'role' => 'user',
        ]);
    }

    public function test_user_cannot_enter_the_admin_dashboard(): void
    {
        $user = User::factory()->create(['role' => 'user']);

        $this->actingAs($user)
            ->get('/admin/dashboard')
            ->assertRedirect('/user/dashboard');
    }

    public function test_invalid_roles_are_forbidden_instead_of_redirecting_forever(): void
    {
        $user = User::factory()->create(['role' => '']);

        $this->actingAs($user)
            ->get('/user/dashboard')
            ->assertForbidden();
    }
}

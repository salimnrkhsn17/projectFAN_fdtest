<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register_and_must_verify_email()
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);
        $response->assertRedirect('/email/verify');
        $this->assertDatabaseHas('users', [
            'email' => 'testuser@example.com',
        ]);
        $user = User::where('email', 'testuser@example.com')->first();
        $this->assertNull($user->email_verified_at);
    }

    public function test_user_can_login_with_correct_credentials()
    {
        $user = User::factory()->create([
            'password' => bcrypt('password123'),
            'email_verified_at' => now(),
        ]);
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password123',
        ]);
        $response->assertRedirect('/dashboard');
        $this->assertAuthenticatedAs($user);
    }

    public function test_user_cannot_login_with_wrong_password()
    {
        $user = User::factory()->create([
            'password' => bcrypt('password123'),
            'email_verified_at' => now(),
        ]);
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrongpassword',
        ]);
        $response->assertSessionHasErrors();
        $this->assertGuest();
    }
}

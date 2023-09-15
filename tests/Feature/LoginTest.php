<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_logged_in_with_valid_credentials_and_valid_token(): void
    {
        $user = User::factory()->create();

        $response = $this->postJson('/api/v1/login', [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['token']);
    }

    public function test_login_returns_validation_error_for_invalid_credentials(): void
    {
        $response = $this->postJson('/api/v1/login', [
            'email' => 'fake@fake.com',
            'password' => 'password'
        ]);

        $response->assertStatus(422);
    }

}

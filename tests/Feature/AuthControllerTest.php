<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create([
            'password' => bcrypt('password'),
        ]);
        $this->token = JWTAuth::fromUser($this->user);
    }

    /** @test */
    public function it_should_login_and_return_a_token()
    {
        $response = $this->postJson('/api/auth/login', [
            'email' => $this->user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure(['access_token', 'token_type', 'expires_in']);
    }

    /** @test */
    public function it_should_get_the_authenticated_user()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->getJson('/api/auth/me');

        $response->assertStatus(200)
                 ->assertJsonFragment(['email' => $this->user->email]);
    }

    /** @test */
    public function it_should_logout_the_user()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->postJson('/api/auth/logout');

        $response->assertStatus(200)
                 ->assertJsonFragment(['message' => 'Successfully logged out']);
    }

    /** @test */
    public function it_should_refresh_the_token()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->postJson('/api/auth/refresh');

        $response->assertStatus(200)
                 ->assertJsonStructure(['access_token', 'token_type', 'expires_in']);
    }
}

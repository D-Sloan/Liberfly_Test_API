<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->token = JWTAuth::fromUser($this->user);
    }

    /** @test */
    public function it_should_list_all_users()
    {
        User::factory()->count(3)->create();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->getJson('/api/users');

        $response->assertStatus(200)
                 ->assertJsonStructure([['id', 'name', 'email']]);
    }

    /** @test */
    public function it_should_show_a_user_by_id()
    {
        $user = User::factory()->create();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->getJson('/api/users/' . $user->id);

        $response->assertStatus(200)
                 ->assertJsonFragment(['email' => $user->email]);
    }

    /** @test */
    public function it_should_create_a_user()
    {
        $data = [
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->postJson('/api/users', $data);

        $response->assertStatus(201)
                 ->assertJsonStructure(['token']);
    }

    /** @test */
    public function it_should_update_a_user()
    {
        $user = User::factory()->create();

        $data = [
            'name' => 'Updated User',
            'email' => 'updateduser@example.com',
            'password' => 'newpassword',
            'password_confirmation' => 'newpassword',
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->putJson('/api/users/' . $user->id, $data);

        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => 'Updated User']);
    }

    /** @test */
    public function it_should_delete_a_user()
    {
        $user = User::factory()->create();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->deleteJson('/api/users/' . $user->id);

        $response->assertStatus(200)
                 ->assertJsonFragment(['message' => 'User deleted successfully.']);
    }
}

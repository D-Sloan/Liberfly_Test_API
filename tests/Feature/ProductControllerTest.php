<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->token=JWTAuth::fromUser($this->user);
    }

    /** @test */
    public function it_should_list_products()
    {
        Product::factory()->count(3)->create(['user_id' => $this->user->id]);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->getJson('/api/products');

        $response->assertStatus(200);
    }

    /** @test */
    public function it_should_create_a_product()
    {
        $data = [
            'name' => 'Product Test',
            'description' => 'Description Test',
            'price' => 100.50,
            'stock' => 10,
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->postJson('/api/products', array_merge($data, ['user_id' => $this->user->id]));

        $response->assertStatus(201)
                 ->assertJsonFragment(['name' => 'Product Test']);
    }

    /** @test */
    public function it_should_show_a_product()
    {
        $product = Product::factory()->create(['user_id' => $this->user->id]);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->getJson('/api/products/' . $product->id);

        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => $product->name]);
    }

    /** @test */
    public function it_should_update_a_product()
    {
        $product = Product::factory()->create(['user_id' => $this->user->id]);

        $data = [
            'name' => 'Updated Product',
            'description' => 'Updated Description',
            'price' => 150.75,
            'stock' => 20,
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->putJson('/api/products/' . $product->id, array_merge($data, ['user_id' => $this->user->id]));

        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => 'Updated Product']);
    }

    /** @test */
    public function it_should_delete_a_product()
    {
        $product = Product::factory()->create(['user_id' => $this->user->id]);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->deleteJson('/api/products/' . $product->id);

        $response->assertStatus(200)
                 ->assertJsonFragment(['message' => 'Product deleted successfully']);
    }
}

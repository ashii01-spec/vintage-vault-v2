<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ProductApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_products()
    {
        // Ensure category exists for factory
        $user = User::factory()->create();
        $category = Category::factory()->create();
        Product::factory()->count(3)->create([
            'user_id' => $user->id,
            'category_id' => $category->id
        ]);

        $response = $this->getJson('/api/products');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'name', 'price', 'description', 'category_id']
                ]
            ]);
    }

    public function test_can_create_product()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        Sanctum::actingAs($user, ['*']);

        $data = [
            'name' => 'New Product',
            'description' => 'Product Description',
            'price' => 100.50,
            'quantity' => 10,
            'category_id' => $category->id,
            'image' => 'http://example.com/image.jpg'
        ];

        $response = $this->postJson('/api/products', $data);

        $response->assertStatus(201)
            ->assertJsonFragment(['name' => 'New Product']);

        $this->assertDatabaseHas('products', ['name' => 'New Product']);
    }

    public function test_validation_errors()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user, ['*']);

        $response = $this->postJson('/api/products', []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'price', 'category_id']);
    }

    public function test_cannot_update_others_product()
    {
        $owner = User::factory()->create();
        $otherUser = User::factory()->create();
        $category = Category::factory()->create();
        
        $product = Product::factory()->create([
            'user_id' => $owner->id,
            'category_id' => $category->id
        ]);

        Sanctum::actingAs($otherUser, ['*']);

        $response = $this->putJson("/api/products/{$product->id}", [
            'name' => 'Hacked Name'
        ]);

        $response->assertStatus(403);
    }

    public function test_can_update_own_product()
    {
        $owner = User::factory()->create();
        $category = Category::factory()->create();
        
        $product = Product::factory()->create([
            'user_id' => $owner->id,
            'category_id' => $category->id
        ]);

        Sanctum::actingAs($owner, ['*']);

        $response = $this->putJson("/api/products/{$product->id}", [
            'name' => 'Updated Name'
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('products', ['name' => 'Updated Name']);
    }

    public function test_cannot_delete_others_product()
    {
        $owner = User::factory()->create();
        $otherUser = User::factory()->create();
        $category = Category::factory()->create();
        
        $product = Product::factory()->create([
            'user_id' => $owner->id,
            'category_id' => $category->id
        ]);

        Sanctum::actingAs($otherUser, ['*']);

        $response = $this->deleteJson("/api/products/{$product->id}");

        $response->assertStatus(403);
    }

    public function test_can_delete_own_product()
    {
        $owner = User::factory()->create();
        $category = Category::factory()->create();
        
        $product = Product::factory()->create([
            'user_id' => $owner->id,
            'category_id' => $category->id
        ]);

        Sanctum::actingAs($owner, ['*']);

        $response = $this->deleteJson("/api/products/{$product->id}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}

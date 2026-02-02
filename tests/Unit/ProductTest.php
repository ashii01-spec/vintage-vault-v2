<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_product_can_be_created()
    {
        // 1. Create dependencies
        $seller = User::factory()->create();
        $category = Category::factory()->create();

        // 2. Define product data
        $productData = [
            'name' => 'Test Vintage Product',
            'description' => 'A description of the product',
            'price' => 150.00,
            'quantity' => 1,
            'category_id' => $category->id,
            'user_id' => $seller->id,
            'image' => 'path/to/image.jpg'
        ];

        // 3. Create product
        $product = Product::create($productData);

        // 4. Assertions
        $this->assertInstanceOf(Product::class, $product);
        $this->assertEquals('Test Vintage Product', $product->name);
        $this->assertDatabaseHas('products', ['name' => 'Test Vintage Product']);
    }

    public function test_product_belongs_to_a_category()
    {
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);

        $this->assertInstanceOf(Category::class, $product->category);
        $this->assertEquals($category->id, $product->category->id);
    }

    public function test_product_belongs_to_a_seller()
    {
        $seller = User::factory()->create();
        $product = Product::factory()->create(['user_id' => $seller->id]);

        $this->assertInstanceOf(User::class, $product->seller);
        $this->assertEquals($seller->id, $product->seller->id);
    }
}

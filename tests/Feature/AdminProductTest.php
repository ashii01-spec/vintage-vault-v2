<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_upload_image_when_creating_product()
    {
        Storage::fake('public');

        $admin = User::factory()->create(['role' => 'admin']);
        $category = Category::factory()->create();
        $seller = User::factory()->create(['role' => 'seller']);

        $file = UploadedFile::fake()->image('product.jpg');

        $response = $this->actingAs($admin)
            ->post(route('admin.products.store'), [
                'name' => 'Test Product',
                'description' => 'Test Description',
                'price' => 100,
                'quantity' => 10,
                'category_id' => $category->id,
                'user_id' => $seller->id,
                'image' => $file,
            ]);

        $response->assertRedirect(route('admin.products.index'));
        
        // Assert the file was stored...
        Storage::disk('public')->assertExists('products/' . $file->hashName());
        
        // Assert database has the path
        $this->assertDatabaseHas('products', [
            'name' => 'Test Product',
            'image' => 'products/' . $file->hashName(),
        ]);
    }

    public function test_admin_can_replace_image_when_updating_product()
    {
        Storage::fake('public');

        $admin = User::factory()->create(['role' => 'admin']);
        $category = Category::factory()->create();
        $seller = User::factory()->create(['role' => 'seller']);

        // Create initial product with image
        $oldFile = UploadedFile::fake()->image('old_product.jpg');
        $oldPath = $oldFile->store('products', 'public');
        
        $product = Product::factory()->create([
            'user_id' => $seller->id,
            'category_id' => $category->id,
            'image' => $oldPath
        ]);

        Storage::disk('public')->assertExists($oldPath);

        // Upload new image
        $newFile = UploadedFile::fake()->image('new_product.jpg');

        $response = $this->actingAs($admin)
            ->put(route('admin.products.update', $product), [
                'name' => 'Updated Product',
                'description' => 'Updated Description',
                'price' => 200,
                'quantity' => 20,
                'category_id' => $category->id,
                'user_id' => $seller->id,
                'image' => $newFile,
            ]);

        $response->assertRedirect(route('admin.products.index'));

        // Old file should be deleted
        Storage::disk('public')->assertMissing($oldPath);
        
        // New file should exist
        Storage::disk('public')->assertExists('products/' . $newFile->hashName());

        // Database should be updated
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'image' => 'products/' . $newFile->hashName(),
        ]);
    }

    public function test_image_is_deleted_when_product_is_deleted()
    {
        Storage::fake('public');

        $admin = User::factory()->create(['role' => 'admin']);
        $product = Product::factory()->create([
            'image' => 'products/test_image.jpg'
        ]);
        
        // Manually put the file there so we can test its deletion
        Storage::disk('public')->put('products/test_image.jpg', 'content');

        $response = $this->actingAs($admin)
            ->delete(route('admin.products.destroy', $product));

        $response->assertRedirect(route('admin.products.index'));

        Storage::disk('public')->assertMissing('products/test_image.jpg');
    }
}

<?php

use App\Http\Controllers\Admin\ProductController;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

echo "Starting manual test...\n";

// Mock Storage
Storage::fake('public');

// Setup Data
$category = Category::first();
if (!$category) $category = Category::factory()->create();

$seller = User::first();
if (!$seller) $seller = User::factory()->create();

$controller = new ProductController();

// 1. Test Store
echo "Testing Store...\n";
$file = UploadedFile::fake()->image('test.jpg');

$request = Request::create('/admin/products', 'POST', [
    'name' => 'Manual Test Product',
    'description' => 'Desc',
    'price' => 123,
    'quantity' => 5,
    'category_id' => $category->id,
    'user_id' => $seller->id,
], [], ['image' => $file]);

// We need to bypass validation in the controller which uses $request->validate()
// Since we are instantiating controller manually, we can't easily bypass validation middleware/features fully
// unless we route it, but let's try calling method directly.
// The controller uses $request->validate() which might throw ValidationException.

try {
    $controller->store($request);
    echo "Store executed.\n";
} catch (\Illuminate\Validation\ValidationException $e) {
    echo "Validation failed: " . json_encode($e->errors()) . "\n";
    exit(1);
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    exit(1);
}

$product = Product::where('name', 'Manual Test Product')->first();
if ($product && $product->image) {
    echo "Product created with image: " . $product->image . "\n";
    if (Storage::disk('public')->exists($product->image)) {
        echo "Image file exists in storage.\n";
    } else {
        echo "Image file MISSING in storage (Fake storage might be tricky with store() method depending on implementation).\n";
        // existing store() uses $file->store(...) which uses the disk config.
        // If we faked 'public', it should be there.
    }
} else {
    echo "Product creation failed or no image.\n";
    exit(1);
}

// 2. Test Update (Replace)
echo "Testing Update (Replace)...\n";
$newFile = UploadedFile::fake()->image('test2.jpg');
$requestUpdate = Request::create('/admin/products/'.$product->id, 'PUT', [
    'name' => 'Manual Test Product Updated',
    'description' => 'Desc',
    'price' => 123,
    'quantity' => 5,
    'category_id' => $category->id,
    'user_id' => $seller->id,
], [], ['image' => $newFile]);

$controller->update($requestUpdate, $product);

$product->refresh();
echo "Product updated image: " . $product->image . "\n";

if (Storage::disk('public')->exists($product->image)) {
    echo "New image exists.\n";
} else {
    echo "New image MISSING.\n";
}

// 3. Test Destroy
echo "Testing Destroy...\n";
$imagePath = $product->image;
$controller->destroy($product);

if (Storage::disk('public')->exists($imagePath)) {
    echo "Image should be deleted but EXISTS.\n";
} else {
    echo "Image deleted successfully.\n";
}

echo "Manual test completed.\n";

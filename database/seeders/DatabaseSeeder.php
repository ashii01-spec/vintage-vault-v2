<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // 1. Create the Admin (Ashmi)
        User::factory()->create([
            'name' => 'Ashmi Admin',
            'email' => 'admin@vintagevault.com',
            'password' => Hash::make('password123'), // Default password
            'role' => 'admin',
        ]);

        // 2. Create a Seller
        User::factory()->create([
            'name' => 'Vintage Seller',
            'email' => 'seller@vintagevault.com',
            'password' => Hash::make('password123'),
            'role' => 'seller',
        ]);

        // 3. Create a Buyer
        User::factory()->create([
            'name' => 'Regular Buyer',
            'email' => 'buyer@vintagevault.com',
            'password' => Hash::make('password123'),
            'role' => 'buyer',
        ]);
        
        // 4. Create some Categories (From Assignment 1)
        Category::create(['name' => 'Books', 'description' => 'Vintage and rare books']);
        Category::create(['name' => 'Electronics', 'description' => 'Retro tech and gadgets']);
        Category::create(['name' => 'Artworks', 'description' => 'Classic paintings and sketches']);
        Category::create(['name' => 'Furniture', 'description' => 'Antique furniture']);
        Category::create(['name' => 'Ornaments', 'description' => 'Decorative vintage items']);
    }
}

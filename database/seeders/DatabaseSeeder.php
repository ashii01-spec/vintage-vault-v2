<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
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
        // 1. Create the Admin (Ashmi)
        User::factory()->create([
            'name' => 'Ashmi Admin',
            'email' => 'admin@vintagevault.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // 2. Create a Seller
        $seller = User::factory()->create([
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
        
        // 4. Create Categories
        $books = Category::create(['name' => 'Books', 'description' => 'Vintage and rare books']);
        $electronics = Category::create(['name' => 'Electronics', 'description' => 'Retro tech and gadgets']);
        $furniture = Category::create(['name' => 'Furniture', 'description' => 'Antique furniture']);
        $ornaments = Category::create(['name' => 'Ornaments', 'description' => 'Decorative vintage items']);
        $artworks = Category::create(['name' => 'Artworks', 'description' => 'Classic paintings and sketches']);

        // 5. Create Products

        // --- Category: Books ---
        $bookList = [
            [
                'name' => 'The Illuminator’s Handbook',
                'description' => 'A detailed guide to Medieval illumination techniques.',
                'price' => 45.00,
                'image' => './public/Images/Products/Books/1.The Illuminator’s Handbook.jpg'
            ],
            [
                'name' => 'The Order of Melchizedek',
                'description' => 'Lessons from the Ascended Masters. Delves into the age-old quest for enlightenment.',
                'price' => 30.00,
                'image' => 'Public/Images/Products/Books/2.The Order of Melchizedek.jpg'
            ],
            [
                'name' => 'The Book of Enoch',
                'description' => 'Ancient Secrets of Enoch: What They Didn’t Want You to Know. Reveals lost biblical truths.',
                'price' => 25.00,
                'image' => 'Public/Images/Products/Books/3. The Book of Enoch with Ancient Secrets of Enoch.jpg'
            ],
            [
                'name' => 'Adam and Eve and the Great Reset',
                'description' => 'How an Ancient Cataclysm Warning Was Silenced for 50 Years. Investigates global floods and lost knowledge.',
                'price' => 35.00,
                'image' => 'Public/Images/Products/Books/4. Adam and Eve and the Great Reset.jpg'
            ],
            [
                'name' => 'The Zoist',
                'description' => 'Volume 2. A Journal Of Cerebral Physiology & Mesmerism (1843-1856).',
                'price' => 40.00,
                'image' => 'Public/Images/Products/Books/5. The Zoist.jpg'
            ],
            [
                'name' => 'The Black Library',
                'description' => 'A Deep Dive into Lost Occult Manuscripts. Exploration of the rarest and most enigmatic grimoires.',
                'price' => 50.00,
                'image' => 'Public/Images/Products/Books/6. The Black Library.jpg'
            ],
        ];

        foreach ($bookList as $item) {
            Product::create([
                'name' => $item['name'],
                'description' => $item['description'],
                'price' => $item['price'],
                'quantity' => rand(10, 50),
                'category_id' => $books->id,
                'user_id' => $seller->id,
                'image' => $item['image'],
            ]);
        }

        // --- Category: Electronics ---
        $elecList = [
            [
                'name' => 'Vintage Rotary Handset Telephone',
                'description' => 'A stylish bronze-look home phone with retro design. Plugs directly into wall jack.',
                'price' => 120.00,
                'image' => 'Public/Images/Products/Electronics/1. Vintage Rotary Handset Decorative Telephone.jpg'
            ],
            [
                'name' => 'Candlestick Telephone Print',
                'description' => 'A photographic print of a classic Candlestick Telephone[cite: 31].',
                'price' => 45.00,
                'image' => 'Public/Images/Products/Electronics/2. ‘Candlestick Telephone’ Photographic Print.jpg'
            ],
            [
                'name' => 'Retro Electronic Tube Clock',
                'description' => 'HAMGEEK WFD Pseudo-Fluorescent Matrix Cyberpunk Spectrum Function clock.',
                'price' => 150.00,
                'image' => 'Public/Images/Products/Electronics/3. HAMGEEK WFD Retro Electronic Tube Clock.jpg'
            ],
            [
                'name' => 'Antique Royal Typewriter',
                'description' => 'Antique Early 1900s Royal Typewriter, believed to be a 1914 ROYAL NO. 10.',
                'price' => 250.00,
                'image' => 'Public/Images/Products/Electronics/4. Antique Royal Typewriter.jpg'
            ],
            [
                'name' => 'Grandfather Wall Clock',
                'description' => 'Vintage Wood-Looking Plastic Pendulum Decorative Battery-Operated Wall Clock.',
                'price' => 85.00,
                'image' => 'Public/Images/Products/Electronics/5. Vintage Grandfather Wood clock.jpg'
            ],
            [
                'name' => 'Vintage Music Box',
                'description' => 'Elegance in Motion. A detailed vintage music box with mechanical movement.',
                'price' => 95.00,
                'image' => 'Public/Images/Products/Electronics/6. Vintage Music Box.jpg'
            ],
        ];

        foreach ($elecList as $item) {
            Product::create([
                'name' => $item['name'],
                'description' => $item['description'],
                'price' => $item['price'],
                'quantity' => rand(5, 20),
                'category_id' => $electronics->id,
                'user_id' => $seller->id,
                'image' => $item['image'],
            ]);
        }

        // --- Category: Furniture ---
        $furnList = [
            [
                'name' => 'Victorian Whatnot Shelves',
                'description' => 'Hand-made, hand-finished Victorian Whatnot shelf. Perfect for displaying antique collections.',
                'price' => 180.00,
                'image' => 'Public/Images/Products/Furniture/1. Victorian Whatnot Shelves.jpg'
            ],
            [
                'name' => 'Saddle Stitch Leather Desk Chair',
                'description' => 'Premium comfort meets refined style. [cite_start]Top-quality leather with detailed saddle stitching[cite: 42, 43].',
                'price' => 350.00,
                'image' => 'Public/Images/Products/Furniture/2. Saddle Stitch Leather Desk Chair.jpg'
            ],
            [
                'name' => 'Victorian Walnut Armoire',
                'description' => 'Exquisite Victorian era walnut wardrobe (circa 1837-1910), meticulously restored.',
                'price' => 1200.00,
                'image' => 'Public/Images/Products/Furniture/3. Early 19th Century Antique Victorian Walnut Armoire, Wardrobe.jpg'
            ],
            [
                'name' => 'Georgian Mahogany Storage Box',
                'description' => 'Elegant vintage mahogany box with Georgian-style curves, ornate brass embellishments, and claw feet.',
                'price' => 220.00,
                'image' => 'Public/Images/Products/Furniture/4. Vintage Georgian Style Mahogany Storage Box.jpg'
            ],
            [
                'name' => 'Antique Vanity Beauty',
                'description' => 'Exquisite antique vanity setup adorned with delicate decor and a touch of floral charm.',
                'price' => 600.00,
                'image' => 'Public/Images/Products/Furniture/5. Vintage Vanity Beauty.jpg'
            ],
            [
                'name' => 'Louis XVI Ormolu Credenza',
                'description' => 'Antique Louis XVI Ormolu Mounted Credenza. A stunning piece of furniture that exudes elegance.',
                'price' => 1500.00,
                'image' => 'Public/Images/Products/Furniture/6. Vintage Louis XVI Ormolu Mounted Credenza.jpg'
            ],
        ];

        foreach ($furnList as $item) {
            Product::create([
                'name' => $item['name'],
                'description' => $item['description'],
                'price' => $item['price'],
                'quantity' => rand(2, 10),
                'category_id' => $furniture->id,
                'user_id' => $seller->id,
                'image' => $item['image'],
            ]);
        }

        // --- Category: Ornaments ---
        $ornList = [
            [
                'name' => 'Bronze and Gold Glass Ornaments',
                'description' => 'Set of 10 handmade bronze and gold glass ornaments with glitter swirls and baroque-style motifs.',
                'price' => 55.00,
                'image' => 'Public/Images/Products/Ornaments/1. Unique Set of 10 Bronze and Gold Glass Christmas Ornaments.jpg'
            ],
            [
                'name' => 'Sterling Silver Flower Brooch',
                'description' => 'Antique Sterling Silver Flower And Cupid Monogrammed Brooch.',
                'price' => 85.00,
                'image' => 'Public/Images/Products/Ornaments/2. Antique Sterling silver flower and cupid monogrammed brooch.jpg'
            ],
            [
                'name' => 'Wrought Iron Gas Lamp',
                'description' => 'Indoor nostalgic wall lamp, double wall sconce.',
                'price' => 75.00,
                'image' => 'Public/Images/Products/Ornaments/3. Wrought Iron Gas Lamp Double Wall Sconce.jpg'
            ],
            [
                'name' => 'Vintage Cuckoo Clock',
                'description' => 'Handcrafted solid linden wood clock with classic German design. Bird sings coo-coo every hour.',
                'price' => 130.00,
                'image' => 'Public/Images/Products/Ornaments/4. Cuckoo Clock Vintage Large Wooden Wall Clock.jpg'
            ],
            [
                'name' => 'Vintage Floral Switch Plate',
                'description' => 'Cast metal with antiqued brass tone finish. Rococo / Hollywood Regency style.',
                'price' => 25.00,
                'image' => 'Public/Images/Products/Ornaments/5. Vintage Floral Switch Plate.jpg'
            ],
            [
                'name' => 'Crown Candle Pin',
                'description' => 'Handcrafted crown candle pin painted by hand with custom colors and added crystals.',
                'price' => 15.00,
                'image' => 'Public/Images/Products/Ornaments/6. Crown Candle Pin.jpg'
            ],
        ];

        foreach ($ornList as $item) {
            Product::create([
                'name' => $item['name'],
                'description' => $item['description'],
                'price' => $item['price'],
                'quantity' => rand(20, 60),
                'category_id' => $ornaments->id,
                'user_id' => $seller->id,
                'image' => $item['image'],
            ]);
        }

        // --- Category: Artworks (Using "Paintings" folder) ---
        $artList = [
            [
                'name' => 'Victorian Ballroom Art',
                'description' => 'Elegant Victorian Ballroom – A Timeless Dance of Grace & Luxury.',
                'price' => 200.00,
                'image' => 'Public/Images/Products/Paintings/1. Victorian Ballroom Art,.jpg' // Note the comma
            ],
            [
                'name' => 'Vintage Botanical Wildflowers',
                'description' => 'Victorian Vintage Botanical Wildflowers Digital Art in oil painting style].',
                'price' => 90.00,
                'image' => 'Public/Images/Products/Paintings/2. Victorian Vintage Botanical Wildflowers Art Digital Products.png' // .png
            ],
            [
                'name' => 'Hand-Painted Oil Painting',
                'description' => 'Incredible Antique Hand-Painted Oil Painting of People Dancing With Fine Detail.',
                'price' => 350.00,
                'image' => 'Public/Images/Products/Paintings/3. Oil Painting Incredible Antique Hand-Painted Oil Painting.png' // .png
            ],
            [
                'name' => 'Wild Flowers Photography Backdrop',
                'description' => 'Avezano Wild Flowers Oil Painting Style Photography Backdrop. Premium polyester-cotton.',
                'price' => 60.00,
                'image' => 'Public/Images/Products/Paintings/4. Avezano Wild Flowers Oil Painting Style Photography Backdrop.jpg'
            ],
            [
                'name' => 'Floral Woman Decoupage Paper',
                'description' => 'Sticky Rice Decoupage Paper featuring a floral woman design. A3 size.',
                'price' => 20.00,
                'image' => 'Public/Images/Products/Paintings/5. Floral Woman Sticky Rice Paper for Decoupage - A3.jpg'
            ],
            [
                'name' => 'Trees Oil Painting Backdrop',
                'description' => 'Avezano Trees Oil Painting Style Photography Backdrop. Durable and portable.',
                'price' => 65.00,
                'image' => 'Public/Images/Products/Paintings/6. Avezano Trees Oil Painting Style Photography Backdrop.jpg'
            ],
        ];

        foreach ($artList as $item) {
            Product::create([
                'name' => $item['name'],
                'description' => $item['description'],
                'price' => $item['price'],
                'quantity' => rand(10, 40),
                'category_id' => $artworks->id,
                'user_id' => $seller->id,
                'image' => $item['image'],
            ]);
        }
    }
}
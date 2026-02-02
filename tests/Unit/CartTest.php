<?php

namespace Tests\Unit;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartTest extends TestCase
{
    use RefreshDatabase;

    public function test_cart_can_be_created_for_user()
    {
        $user = User::factory()->create();      
        $cart = Cart::create([
            'user_id' => $user->id
        ]);
        $this->assertInstanceOf(Cart::class, $cart);
        $this->assertEquals($user->id, $cart->user_id);
    }

    public function test_cart_can_have_items()
    {
        $user = User::factory()->create();
        $cart = Cart::create(['user_id' => $user->id]);
        $product = Product::factory()->create();

        $cartItem = CartItem::create([
            'cart_id' => $cart->id,
            'product_id' => $product->id,
            'quantity' => 2
        ]);
        $this->assertTrue($cart->items->contains($cartItem));
        $this->assertEquals(1, $cart->items->count());
        $this->assertEquals(2, $cart->items->first()->quantity);
    }

    public function test_cart_item_belongs_to_product()
    {
        $user = User::factory()->create();
        $cart = Cart::create(['user_id' => $user->id]);
        $product = Product::factory()->create(['name' => 'Test Product']);
        $cartItem = CartItem::create([
            'cart_id' => $cart->id,
            'product_id' => $product->id,
            'quantity' => 1
        ]);
        $this->assertInstanceOf(Product::class, $cartItem->product);
        $this->assertEquals('Test Product', $cartItem->product->name);
    }
}

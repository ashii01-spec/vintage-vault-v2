<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShopIndex extends Component
{
    public $selectedCategory = null;
    public $search = '';

    // ADD TO CART Function
    public function addToCart($productId)
    {
        // 1. Check if user is logged in
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // 2. Find or Create the User's Cart
        $cart = Cart::firstOrCreate(
            ['user_id' => Auth::id()]
        );

        // 3. Check if the item is already in the cart
        $cartItem = CartItem::where('cart_id', $cart->id)
                            ->where('product_id', $productId)
                            ->first();

        if ($cartItem) {
            // Update quantity if exists
            $cartItem->increment('quantity');
        } else {
            // Create new item if not
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $productId,
                'quantity' => 1
            ]);
        }

        // 4. Show a success message (Toast)
        session()->flash('message', 'Item added to your collection!');
    }

    // RENDER Function
    public function render()
    {
        $categories = Category::all();
        $products = Product::query()
            ->when($this->selectedCategory, function ($query) {
                $query->where('category_id', $this->selectedCategory);
            })
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->get();

        return view('livewire.shop-index', [
            'products' => $products,
            'categories' => $categories,
        ])->layout('layouts.frontend');
    }

    public function filterByCategory($categoryId) {
        $this->selectedCategory = $categoryId;
    }
}
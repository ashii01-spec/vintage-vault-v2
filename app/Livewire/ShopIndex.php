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

    public function addToCart($productId)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $cart = Cart::firstOrCreate(
            ['user_id' => Auth::id()]
        );

        $cartItem = CartItem::where('cart_id', $cart->id)
                            ->where('product_id', $productId)
                            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $productId,
                'quantity' => 1
            ]);
        }

        session()->flash('message', 'Item added to your collection!');
    }

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
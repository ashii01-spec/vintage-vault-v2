<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CartIndex extends Component
{
    public $cartItems = [];
    public $total = 0;

    public function mount()
    {
        $this->loadCart();
    }

    public function loadCart()
    {
        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())->with('items.product')->first();
            if ($cart) {
                $this->cartItems = $cart->items;
                $this->total = $this->cartItems->sum(function($item) {
                    return $item->quantity * $item->product->price;
                });
            } else {
                $this->cartItems = [];
            }
        }
    }

    public function incrementQty($itemId)
    {
        $item = CartItem::find($itemId);
        if ($item) {
            $item->increment('quantity');
            $this->loadCart();
        }
    }

    public function decrementQty($itemId)
    {
        $item = CartItem::find($itemId);
        if ($item && $item->quantity > 1) {
            $item->decrement('quantity');
            $this->loadCart();
        }
    }

    public function removeItem($itemId)
    {
        $item = CartItem::find($itemId);
        if ($item) {
            $item->delete();
            $this->loadCart();
            session()->flash('message', 'Item removed from cart.');
        }
    }

    public function render()
    {
        return view('livewire.cart-index')->layout('layouts.frontend');
    }
}
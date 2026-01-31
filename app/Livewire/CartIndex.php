<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
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

    public function checkout()
    {
        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())->with('items.product')->first();
            if ($cart && $cart->items->count() > 0) {
                // 1. Create the Order
                $order = Order::create([
                    'user_id' => Auth::id(),
                    'total_price' => $this->total,
                    'status' => 'pending',
                ]);

                // 2. Create Order Items
                foreach ($cart->items as $cartItem) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $cartItem->product_id,
                        'quantity' => $cartItem->quantity,
                        'price' => $cartItem->product->price,
                    ]);
                }

                // 3. Dispatch browser event with the total amount
                $this->dispatch('checkout-complete', total: $this->total);

                // 4. Clear the cart items
                $cart->items()->delete();
                
                // 5. Refresh the component state
                $this->loadCart();

                session()->flash('message', 'Checkout successful! Your order has been placed.');
            }
        }
    }

    public function render()
    {
        return view('livewire.cart-index')->layout('layouts.frontend');
    }
}
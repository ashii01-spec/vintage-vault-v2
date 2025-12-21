<?php

namespace App\Livewire;

use Livewire\Component;

class ShopIndex extends Component
{
    public function render()
    {
        // Fetch categories for the filter sidebar
        $categories = Category::all();

        // Fetch products based on search and category filter
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
        ])->layout('layouts.frontend'); // Use our custom layout
    }
}

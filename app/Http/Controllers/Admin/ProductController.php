<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'seller'])->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $sellers = User::all();
        return view('admin.products.create', compact('categories', 'sellers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'user_id' => 'required|exists:users,id',
            'image' => 'image|nullable'
        ]);

        $data = $request->all();
        // $data['user_id'] = Auth::id(); // Removed: Admin selects the seller

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Item created successfully.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $sellers = User::all();
        return view('admin.products.edit', compact('product', 'categories', 'sellers'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'user_id' => 'required|exists:users,id',
            'image' => 'image|nullable'
        ]);
    
        $data = $request->except(['image', 'remove_image']);
    
        // 1. Handle "Remove Image" Checkbox
        if ($request->has('remove_image')) {
            // Delete the file from storage
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            // Set database column to null
            $data['image'] = null;
        }
    
        // 2. Handle New Image Upload (Overrides removal if both are selected)
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            // Store new image
            $data['image'] = $request->file('image')->store('products', 'public');
        }
    
        $product->update($data);
    
        return redirect()->route('admin.products.index')->with('success', 'Artifact updated successfully.');
    }

    public function destroy(Product $product)
    {
        if($product->image) Storage::disk('public')->delete($product->image);
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Item deleted.');
    }
}
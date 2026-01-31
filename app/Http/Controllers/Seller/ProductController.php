<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('user_id', Auth::id())->with('category')->paginate(10);
        return view('seller.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('seller.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'image' => 'image|nullable'
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('seller.products.index')->with('success', 'Artifact listed successfully.');
    }

    public function edit(Product $product)
    {
        // Security check: Ensure seller owns this product
        if ($product->user_id !== Auth::id()) {
            abort(403);
        }

        $categories = Category::all();
        return view('seller.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        // Security check
        if ($product->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'image' => 'image|nullable'
        ]);
    
        $data = $request->except(['image', 'remove_image']);
    
        if ($request->has('remove_image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = null;
        }
    
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }
    
        $product->update($data);
    
        return redirect()->route('seller.products.index')->with('success', 'Artifact updated successfully.');
    }

    public function destroy(Product $product)
    {
        // Security check
        if ($product->user_id !== Auth::id()) {
            abort(403);
        }

        if($product->image) Storage::disk('public')->delete($product->image);
        $product->delete();
        return redirect()->route('seller.products.index')->with('success', 'Artifact removed.');
    }
}

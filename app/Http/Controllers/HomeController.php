<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch 3 random items for the "Featured" section
        $featuredProducts = Product::with('category')->inRandomOrder()->take(3)->get();
        
        return view('home', compact('featuredProducts'));
    }

    public function gallery()
    {
        $products = Product::with('category')->latest()->get();
        return view('gallery', compact('products'));
    }

    public function contact()
    {
        return view('contact');
    }
}
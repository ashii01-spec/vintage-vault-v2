<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $role = Auth::user()->role;

        if ($role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($role === 'buyer') {
            return redirect()->route('shop');
        } elseif ($role === 'seller') {
            return redirect()->route('seller.products');
        }

        return view('dashboard');
    }
}

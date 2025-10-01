<?php

// app/Http/Controllers/Customer/MenuController.php
namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function enterName(Request $request)
    {
        $table = $request->get('table');
        return view('customer.welcome', compact('table'));
    }

    public function startOrder(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'table_number' => 'nullable|string|max:50',
        ]);

        session([
            'customer_name' => $request->customer_name,
            'table_number' => $request->table_number,
        ]);

        return redirect()->route('customer.menu');
    }

    public function index(Request $request)
    {
        if (!session('customer_name')) {
            return redirect()->route('customer.name');
        }

        $categorySlug = $request->get('category');
        
        $categories = Category::withCount('products')->get();
        
        $products = Product::with('category')
            ->where('is_available', true)
            ->when($categorySlug, function ($query) use ($categorySlug) {
                $query->whereHas('category', function ($q) use ($categorySlug) {
                    $q->where('slug', $categorySlug);
                });
            })
            ->orderBy('name')
            ->get();

        $cart = session('cart', []);
        $cartCount = array_sum(array_column($cart, 'quantity'));

        return view('customer.menu', compact('categories', 'products', 'cart', 'cartCount'));
    }
}



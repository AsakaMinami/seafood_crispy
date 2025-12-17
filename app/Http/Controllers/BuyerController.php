<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class BuyerController extends Controller
{
    /**
     * Dashboard buyer
     * Menampilkan produk dengan pagination + search
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Query dasar produk
        $products = Product::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(12)
            ->withQueryString(); // agar search tidak hilang saat pindah halaman

        return view('buyer.dashboard', compact('products'));
    }

    /**
     * Detail produk
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('buyer.detail', compact('product'));
    }
}

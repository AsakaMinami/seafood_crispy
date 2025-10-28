<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product; // pastikan model Product sudah ada
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Ambil query pencarian dari input form
        $search = $request->input('search');

        // Ambil produk, bisa difilter pakai pencarian
        $products = Product::when($search, function ($query, $search) {
                $query->where('nama', 'like', "%{$search}%")
                      ->orWhere('deskripsi', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(9);

        // Kirim ke view
        return view('buyer.dashboard', compact('products'));
    }
}

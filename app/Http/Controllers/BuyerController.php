<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class BuyerController extends Controller
{
    /**
     * Menampilkan dashboard pembeli dengan produk yang dipaginasi
     * untuk mencegah kehabisan memori.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        // 1. Mulai query produk
        $query = Product::query(); 

        // 2. Terapkan pencarian jika ada
        if ($search) {
            $query->where('nama', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
        }
        
        // 3. MENGGUNAKAN PAGINATION (SOLUSI UTAMA MASALAH MEMORI)
        // Hanya memuat 12 produk per halaman ke dalam memori.
        $products = $query->latest()->paginate(12);

        return view('buyer.dashboard', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        // Pastikan nama view sudah benar
        return view('buyer.detail', compact('product'));
    }
}

<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Menampilkan daftar pesanan milik buyer yang sedang login.
     */
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->latest()->paginate(10);
        return view('buyer.orders.index', compact('orders'));
    }

    /**
     * Menyimpan pesanan baru saat buyer menekan tombol "Beli Sekarang".
     */
    public function store($productId)
    {
        // Pastikan produk ada
        $product = Product::findOrFail($productId);

        // Simpan pesanan
        Order::create([
            'user_id'     => Auth::id(),
            'product_id'  => $product->id,
            'quantity'    => 1, // default beli 1 dulu
            'total_price' => $product->price,
            'status'      => 'pending',
        ]);

        // Redirect ke halaman daftar pesanan
        return redirect()->route('buyer.orders.index')
                         ->with('success', 'Pesanan berhasil dibuat!');

        // Ambil pesanan milik user yang sedang login
        $orders = Order::with('product')
                    ->where('user_id', Auth::id())
                    ->latest()
                    ->get();

        return view('buyer.orders.index', compact('orders'));
    }
}


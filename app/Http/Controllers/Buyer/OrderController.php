<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;

class OrderController extends Controller
{
    // =========================
    // LIST PESANAN BUYER
    // =========================
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('buyer.orders.index', compact('orders'));
    }

    // =========================
    // HALAMAN CHECKOUT
    // =========================
    public function checkout(Product $product)
    {
        return view('buyer.checkout', compact('product'));
    }

    // =========================
    // PROSES KONFIRMASI
    // =========================
    public function confirm(Request $request, Product $product)
    {
        $request->validate([
            'nama_penerima' => 'required|string|max:255',
            'alamat'        => 'required|string|max:500',
            'no_hp'         => 'required|string|max:15',
        ]);

        Order::create([
            'user_id'       => auth()->id(),
            'product_id'    => $product->id,
            'quantity'      => 1,
            'total'         => $product->price,
            'total_price'   => $product->price,
            'status'        => 'pending',
            'nama_penerima' => $request->nama_penerima,
            'alamat'        => $request->alamat,
            'no_hp'         => $request->no_hp,
        ]);

        return redirect()->route('buyer.orders.index')
            ->with('success', 'Pesanan berhasil dibuat');
    }
}

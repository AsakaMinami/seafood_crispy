<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Menampilkan halaman keranjang
    public function index()
    {
        // Ambil data keranjang dari session
        $cart = session()->get('cart', []);

        // Hitung total harga
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Kirim ke view
        return view('buyer.cart.index', compact('cart', 'total'));
    }

    // Tambahkan produk ke keranjang
    public function add(Product $product)
    {
        $cart = session()->get('cart', []);
        $id = $product->id;

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);
        session()->put('cart_count', count($cart)); // update badge di navbar

        return redirect()->back()->with('success', 'Produk ditambahkan ke keranjang!');
    }

    // Hapus item dari keranjang
    public function remove($id)
    {
        $cart = session()->get('cart', []);
        unset($cart[$id]);
        session()->put('cart', $cart);
        session()->put('cart_count', count($cart)); // update badge

        return redirect()->back()->with('success', 'Produk dihapus dari keranjang!');
    }

    // Checkout (bisa nanti kamu sambungkan ke Order)
    public function checkout()
    {
        // Nanti bisa disambung ke OrderController
        return redirect()->route('buyer.orders.index')->with('success', 'Checkout berhasil!');
    }
}

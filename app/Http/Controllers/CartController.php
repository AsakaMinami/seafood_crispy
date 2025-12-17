<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;

class CartController extends Controller
{
    // ======================
    // TAMPILKAN KERANJANG
    // ======================
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('buyer.cart.index', compact('cart', 'total'));
    }

    // ======================
    // TAMBAH KE KERANJANG
    // ======================
    public function add(Product $product)
    {
        $cart = session()->get('cart', []);
        $id = $product->id;

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'name'     => $product->name,
                'price'    => $product->price,
                'image'    => $product->image,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);
        session()->put('cart_count', count($cart));

        return back()->with('success', 'Produk ditambahkan ke keranjang');
    }

    // ======================
    // HAPUS DARI KERANJANG
    // ======================
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        unset($cart[$id]);

        session()->put('cart', $cart);
        session()->put('cart_count', count($cart));

        return back()->with('success', 'Produk dihapus dari keranjang');
    }

    // ======================
    // HALAMAN CHECKOUT
    // ======================
    public function checkoutPage()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('buyer.cart')
                ->with('error', 'Keranjang masih kosong');
        }

        $productId = array_key_first($cart);
        $product = Product::findOrFail($productId);

        return view('buyer.checkout', compact('cart', 'product'));
    }

    // ======================
    // PROSES KONFIRMASI
    // ======================
    public function confirm(Request $request)
    {
        $request->validate([
            'nama_penerima' => 'required|string|max:255',
            'alamat'        => 'required|string|max:500',
            'no_hp'         => 'required|string|max:15',
        ]);

        $cart = session()->get('cart', []);

        foreach ($cart as $productId => $item) {
            Order::create([
                'user_id'      => auth()->id(),
                'product_id'   => $productId,
                'quantity'     => $item['quantity'],
                'total_price'  => $item['price'] * $item['quantity'], // ✅ FIX UTAMA
                'status'       => 'pending',
                'customer_name'=> $request->nama_penerima,
            ]);
        }

        session()->forget(['cart', 'cart_count']);

        return redirect()->route('buyer.orders.index')
            ->with('success', 'Pesanan berhasil dibuat');
    }
}

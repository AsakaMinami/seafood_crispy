<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:seller']);
    }

    /**
     * Tampilkan semua produk milik seller
     */
    public function index()
    {
        $products = Product::where('seller_id', Auth::id())
            ->latest()
            ->get();

        return view('seller.products.index', compact('products'));
    }

    /**
     * Form tambah produk
     */
    public function create()
    {
        return view('seller.products.create');
    }

    /**
     * Simpan produk baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'image'       => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // upload gambar
        $path = $request->file('image')->store('products', 'public');

        Product::create([
            'seller_id'   => Auth::id(),
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => $request->price,
            'stock'       => $request->stock,
            'image'       => $path,
        ]);

        return redirect()
            ->route('seller.products.index')
            ->with('success', 'Produk berhasil ditambahkan');
    }

    /**
     * Form edit produk
     */
    public function edit(Product $product)
    {
        if ($product->seller_id !== Auth::id()) {
            abort(403, 'Akses ditolak');
        }

        return view('seller.products.edit', compact('product'));
    }

    /**
     * Update produk
     */
    public function update(Request $request, Product $product)
    {
        if ($product->seller_id !== Auth::id()) {
            abort(403, 'Akses ditolak');
        }

        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $imagePath = $request->file('image')->store('products', 'public');
        } else {
            $imagePath = $product->image;
        }

        $product->update([
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => $request->price,
            'stock'       => $request->stock,
            'image'       => $imagePath,
        ]);

        return redirect()
            ->route('seller.products.index')
            ->with('success', 'Produk berhasil diperbarui');
    }

    /**
     * Hapus produk
     */
    public function destroy(Product $product)
    {
        if ($product->seller_id !== Auth::id()) {
            abort(403, 'Akses ditolak');
        }

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()
            ->route('seller.products.index')
            ->with('success', 'Produk berhasil dihapus');
    }
}

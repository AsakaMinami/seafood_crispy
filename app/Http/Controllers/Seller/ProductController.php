<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product; // Pastikan model Product di-import
use Illuminate\Support\Facades\Auth; // Import kelas Auth
use Illuminate\Support\Facades\Storage; // Import kelas Storage

class ProductController extends Controller
{

    /**
     * Terapkan middleware untuk otentikasi peran.
     */
    public function __construct()
    {
        $this->middleware(['auth', 'role:seller']);
    }

    /**
     * Tampilkan daftar semua produk penjual.
     */
    public function index()
    {

        // Ambil hanya produk yang dimiliki oleh penjual yang sedang login
        $products = Auth::user()->products()->latest()->get();
        return view('seller.products.index', compact('products'));
    }

    /**
     * Tampilkan formulir untuk membuat produk baru.
     */
    public function create()
    {
        // Logika untuk menampilkan formulir tambah produk
        return view('seller.products.create');
    }

    /**
     * Simpan produk baru ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi data yang masuk
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // 2. Upload gambar jika ada
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        // 3. Simpan produk ke database
        Auth::user()->products()->create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $imagePath,
        ]);

        // 4. Arahkan pengguna kembali dengan pesan sukses
        return redirect()->route('seller.products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

   /**
     * Tampilkan produk tertentu.
     */
    public function show($id)
    {
        // Logika untuk menampilkan satu produk
    }

    /**
     * Tampilkan formulir untuk mengedit produk.
     */
    public function edit(Product $product)
    {
        // Pastikan penjual hanya bisa mengedit produk mereka sendiri
        if ($product->user_id !== Auth::id()) {
            abort(403, 'Akses Ditolak');
        }
        return view('seller.products.edit', compact('product'));
    }

    /**
     * Perbarui produk di database.
     */
    public function update(Request $request, Product $product)
    {
        // Pastikan penjual hanya bisa memperbarui produk mereka sendiri
        if ($product->user_id !== Auth::id()) {
            abort(403, 'Akses Ditolak');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $imagePath = $request->file('image')->store('products', 'public');
        } else {
            $imagePath = $product->image;
        }

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $imagePath,
        ]);

        return redirect()->route('seller.products.index')->with('success', 'Produk berhasil diperbarui!');
    }

    /**
     * Hapus produk dari database.
     */
    public function destroy(Product $product)
    {
        // Pastikan penjual hanya bisa menghapus produk mereka sendiri
        if ($product->user_id !== Auth::id()) {
            abort(403, 'Akses Ditolak');
        }

        // Hapus gambar dari penyimpanan
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('seller.products.index')->with('success', 'Produk berhasil dihapus!');
    }
}

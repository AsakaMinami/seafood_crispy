<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GambarBarang;

class GambarBarangController extends Controller
{
    public function index()
    {
        $gambars = GambarBarang::where('user_id', auth()->id())->get();
        return view('seller.gambar_barang.index', compact('gambars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = $request->file('gambar')->store('gambar_barang', 'public');

        GambarBarang::create([
            'user_id' => auth()->id(),
            'path' => $path,
        ]);

        return redirect()->route('seller.gambar.index')->with('success', 'Gambar berhasil diupload!');
    }
}

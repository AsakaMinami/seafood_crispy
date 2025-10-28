<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('seller.profile.index', compact('user'));
    }

    public function edit()
    {
        $user = auth()->user();
        return view('seller.profile.edit', compact('user'));
    }

public function update(Request $request)
{
    $user = auth()->user();

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'password' => 'nullable|min:6|confirmed',
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Update nama & email
    $user->name = $request->name;
    $user->email = $request->email;

    // Update password jika diisi
    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    // Upload foto profil baru (jika ada)
    if ($request->hasFile('profile_picture')) {
        // Hapus foto lama kalau ada
        if ($user->profile_picture && file_exists(public_path('uploads/profile_pictures/' . $user->profile_picture))) {
            unlink(public_path('uploads/profile_pictures/' . $user->profile_picture));
        }

        // Simpan foto baru
        $filename = time() . '.' . $request->file('profile_picture')->extension();
        $request->file('profile_picture')->move(public_path('uploads/profile_pictures'), $filename);

        // Simpan nama file ke kolom user
        $user->profile_picture = $filename;
    }

    // Simpan perubahan ke database
    $user->save();

    return redirect()->route('seller.profile')->with('success', 'Profil berhasil diperbarui!');
}

}

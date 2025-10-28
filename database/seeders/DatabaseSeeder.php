<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Pastikan peran sudah ada sebelum membuat pengguna
        $this->call([
            RolesTableSeeder::class,
        ]);

        // Buat akun Admin
        User::firstOrCreate([
            'email' => 'admin@gmail.com',
        ], [
            'name' => 'admin',
            'password' => Hash::make('admin123'),
            'role_id' => Role::where('name', 'admin')->first()->id,
        ]);
        
        // Buat akun Seller
        User::firstOrCreate([
            'email' => 'seller@gmail.com',
        ], [
            'name' => 'seller',
            'password' => Hash::make('seller123'),
            'role_id' => Role::where('name', 'seller')->first()->id,
        ]);

        // Buat akun Buyer (sudah ada, tapi kita pastikan saja)
        User::firstOrCreate([
            'email' => 'buyer@gmail.com',
        ], [
            'name' => 'buyer',
            'password' => Hash::make('buyer123'),
            'role_id' => Role::where('name', 'buyer')->first()->id,
        ]);
    }
}
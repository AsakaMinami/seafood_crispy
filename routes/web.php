<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\Seller\GambarBarangController;
use App\Http\Controllers\Buyer\OrderController as BuyerOrderController;
use App\Http\Controllers\Seller\OrderController as SellerOrderController;
use App\Http\Controllers\Buyer\ProfileController as BuyerProfileController;
use App\Http\Controllers\Buyer\ProductController as BuyerProductController;
use App\Http\Controllers\Seller\ProfileController as SellerProfileController;
use App\Http\Controllers\Seller\ProductController as SellerProductController;
use App\Http\Controllers\Buyer\DashboardController as BuyerDashboardController;
use App\Http\Controllers\Seller\DashboardController as SellerDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Rute web utama untuk aplikasi.
|
*/

// 🏠 Redirect halaman utama ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// 🔐 Rute otentikasi bawaan Laravel
Auth::routes();

// Semua rute di bawah ini memerlukan login
Route::middleware(['auth'])->group(function () {

    // Rute default setelah login (Home)
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    /*
    |--------------------------------------------------------------------------
    | ADMIN ROUTES
    |--------------------------------------------------------------------------
    */
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->middleware('role:admin')->name('admin.dashboard');

    /*
    |--------------------------------------------------------------------------
    | BUYER ROUTES
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:buyer'])->prefix('buyer')->name('buyer.')->group(function () {

        // Dashboard Buyer
        Route::get('/dashboard', [BuyerDashboardController::class, 'index'])->name('dashboard');

        // Detail Produk (gunakan salah satu controller saja)
        Route::get('/products/{id}', [BuyerProductController::class, 'show'])->name('products.show');

        //buyer order
        Route::post('/order/{product}', [BuyerOrderController::class, 'store'])->name('order.store');
        Route::get('/orders', [BuyerOrderController::class, 'index'])->name('orders.index');

        // Profile Buyer 
        Route::get('/profile', [BuyerProfileController::class, 'index'])->name('profile');
        Route::post('/profile/update', [BuyerProfileController::class, 'update'])->name('profile.update');

        // KERANJANG BUYER
        Route::get('/cart', [CartController::class, 'index'])->name('cart');
        Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
        Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
        Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

    });

    /*
    |--------------------------------------------------------------------------
    | SELLER ROUTES
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:seller'])->prefix('seller')->name('seller.')->group(function () {

        // Dashboard Seller
        Route::get('/dashboard', [SellerDashboardController::class, 'index'])->name('dashboard');

        // Profile Seller
        Route::get('/profile', [SellerProfileController::class, 'index'])->name('profile');
        Route::get('/profile/edit', [SellerProfileController::class, 'edit'])->name('profile.edit');
        Route::post('/profile/update', [SellerProfileController::class, 'update'])->name('profile.update');

        // Produk CRUD
        Route::resource('products', SellerProductController::class)->names([
            'index'   => 'products.index',
            'create'  => 'products.create',
            'store'   => 'products.store',
            'show'    => 'products.show',
            'edit'    => 'products.edit',
            'update'  => 'products.update',
            'destroy' => 'products.destroy',
        ]);

        // Gambar Barang
        Route::get('/gambar-barang', [GambarBarangController::class, 'index'])->name('gambar.index');
        Route::post('/gambar-barang', [GambarBarangController::class, 'store'])->name('gambar.store');

        // Pesanan Seller
        Route::get('/pesanan', [SellerOrderController::class, 'index'])->name('pesanan');
        Route::post('/pesanan/{id}/update-status', [SellerOrderController::class, 'updateStatus'])->name('pesanan.updateStatus');
        Route::delete('/pesanan/{id}', [SellerOrderController::class, 'destroy'])->name('pesanan.destroy');

    });
});
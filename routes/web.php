<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Buyer\OrderController as BuyerOrderController;
use App\Http\Controllers\Seller\OrderController as SellerOrderController;
use App\Http\Controllers\Seller\GambarBarangController;
use App\Http\Controllers\Buyer\ProfileController as BuyerProfileController;
use App\Http\Controllers\Buyer\ProductController as BuyerProductController;
use App\Http\Controllers\Seller\ProfileController as SellerProfileController;
use App\Http\Controllers\Seller\ProductController as SellerProductController;
use App\Http\Controllers\Buyer\DashboardController as BuyerDashboardController;
use App\Http\Controllers\Seller\DashboardController as SellerDashboardController;

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    /*
    |--------------------------------------------------------------------------
    | ADMIN
    |--------------------------------------------------------------------------
    */
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->middleware('role:admin')->name('admin.dashboard');

    /*
    |--------------------------------------------------------------------------
    | BUYER
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:buyer'])
        ->prefix('buyer')
        ->name('buyer.')
        ->group(function () {

            // Dashboard
            Route::get('/dashboard', [BuyerDashboardController::class, 'index'])
                ->name('dashboard');

            // Produk
            Route::get('/products/{id}', [BuyerProductController::class, 'show'])
                ->name('products.show');

            // Orders
            Route::get('/orders', [BuyerOrderController::class, 'index'])
                ->name('orders.index');

            Route::get('/checkout/{product}', [BuyerOrderController::class, 'checkout'])
                ->name('orders.checkout');

            Route::post('/checkout/confirm/{product}', [BuyerOrderController::class, 'confirm'])
                ->name('orders.confirm');

            // Cart (HANYA KERANJANG, TIDAK CREATE ORDER)
            Route::get('/cart', [CartController::class, 'index'])->name('cart');
            Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
            Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

            // Profile
            Route::get('/profile', [BuyerProfileController::class, 'index'])
                ->name('profile');
            Route::post('/profile/update', [BuyerProfileController::class, 'update'])
                ->name('profile.update');
        });

    /*
    |--------------------------------------------------------------------------
    | SELLER
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:seller'])
        ->prefix('seller')
        ->name('seller.')
        ->group(function () {

            // Dashboard
            Route::get('/dashboard', [SellerDashboardController::class, 'index'])
                ->name('dashboard');

            // Profile
            Route::get('/profile', [SellerProfileController::class, 'index'])
                ->name('profile');
            Route::get('/profile/edit', [SellerProfileController::class, 'edit'])
                ->name('profile.edit');
            Route::post('/profile/update', [SellerProfileController::class, 'update'])
                ->name('profile.update');

            // Produk CRUD
            Route::resource('products', SellerProductController::class);

            // Gambar barang
            Route::get('/gambar-barang', [GambarBarangController::class, 'index'])
                ->name('gambar.index');
            Route::post('/gambar-barang', [GambarBarangController::class, 'store'])
                ->name('gambar.store');

            // Pesanan
            Route::get('/pesanan', [SellerOrderController::class, 'index'])
                ->name('pesanan');
            Route::post('/pesanan/{id}/update-status', [SellerOrderController::class, 'updateStatus'])
                ->name('pesanan.updateStatus');
            Route::delete('/pesanan/{id}', [SellerOrderController::class, 'destroy'])
                ->name('pesanan.destroy');
        });
});

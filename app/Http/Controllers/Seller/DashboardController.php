<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $sellerId = Auth::id();

        $productsCount = Product::where('seller_id', $sellerId)->count();

        // hanya satu return view
        return view('seller.dashboard', compact('productsCount'));
    }

    public function pesanan()
    {
        $orders = Order::where('seller_id', Auth::id())->latest()->paginate(10);

        return view('seller.pesanan', compact('orders'));
    }
}

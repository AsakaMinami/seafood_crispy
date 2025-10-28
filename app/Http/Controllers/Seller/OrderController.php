<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Tampilkan semua pesanan
    public function index()
    {
        $orders = Order::latest()->get(); // semua pesanan karena cuma 1 seller
        return view('seller.pesanan', compact('orders'));
    }

    // Update status pesanan
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        // Ubah status sesuai input
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui!');
    }

    // Hapus pesanan (hanya jika status selesai)
    public function destroy($id)
    {
        $order = Order::findOrFail($id);

        if ($order->status !== 'selesai') {
            return redirect()->back()->with('error', 'Pesanan hanya bisa dihapus jika statusnya selesai!');
        }

        $order->delete();
        return redirect()->back()->with('success', 'Pesanan berhasil dihapus!');
    }
}

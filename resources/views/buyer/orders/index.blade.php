@extends('layouts.buyer')

@section('content')
<div class="container py-5 text-white">
    <h2 class="fw-bold mb-4 text-center">Daftar Pesanan Saya</h2>

    @if($orders->isEmpty())
        <div class="text-center py-5">
            <p class="fs-5 text-light">Kamu belum memiliki pesanan.</p>
            <a href="{{ route('buyer.dashboard') }}" class="btn btn-outline-light rounded-pill mt-3">
                Belanja Sekarang
            </a>
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-dark table-striped align-middle text-center">
                <thead class="table-primary text-dark">
                    <tr>
                        <th>#</th>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th>Tanggal Pesanan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $index => $order)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $order->product->name ?? '-' }}</td>
                            <td>{{ $order->quantity ?? 1 }}</td>
                            <td>Rp{{ number_format($order->total_price ?? 0, 0, ',', '.') }}</td>
                            <td>
                                <span class="badge 
                                    @if($order->status == 'pending') bg-warning text-dark
                                    @elseif($order->status == 'completed') bg-success
                                    @else bg-secondary
                                    @endif">
                                    {{ ucfirst($order->status ?? 'pending') }}
                                </span>
                            </td>
                            <td>{{ $order->created_at->format('d M Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection

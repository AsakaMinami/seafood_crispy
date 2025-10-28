@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body">
            <h3 class="mb-4 text-center">
                📦 <strong>Daftar Pesanan Pembeli</strong>
            </h3>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle text-center">
                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>Pembeli</th>
                            <th>Produk</th>
                            <th>Jumlah</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $order->user->name ?? '-' }}</td>
                                <td>{{ $order->product->name ?? '-' }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                <td>
                                    <span class="badge 
                                        @if($order->status == 'pending') bg-warning text-dark 
                                        @elseif($order->status == 'dikirim') bg-secondary 
                                        @elseif($order->status == 'selesai') bg-success 
                                        @else bg-secondary
                                        @endif">
                                        {{ ucfirst($order->status ?? 'pending') }}
                                    </span>
                                </td>
                                <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                                <td>
                                    {{-- Form ubah status --}}
                                    <form action="{{ route('seller.pesanan.updateStatus', $order->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <select name="status" onchange="this.form.submit()" class="form-select form-select-sm">
                                            <option value="pending" {{ ($order->status ?? '') == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="dikirim" {{ ($order->status ?? '') == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                                            <option value="selesai" {{ ($order->status ?? '') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                        </select>
                                    </form>

                                    {{-- Hapus pesanan (hanya jika selesai) --}}
                                    @if(($order->status ?? '') == 'selesai')
                                        <form action="{{ route('seller.pesanan.destroy', $order->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus pesanan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger ms-1">🗑️</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">Belum ada pesanan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

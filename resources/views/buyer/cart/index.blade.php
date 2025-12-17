@extends('layouts.buyer')

@section('content')
<div class="container py-5 text-white">
    <h2 class="mb-4 text-center">🛒 Keranjang Belanja</h2>

    @if(count($cart) > 0)
        <div class="table-responsive">
            <table class="table table-dark table-striped align-middle">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $id => $item)
                        <tr>
                            <td>
                                <img src="{{ asset('storage/' . $item['image']) }}" width="60" class="rounded me-2">
                                {{ $item['name'] }}
                            </td>
                            <td>Rp{{ number_format($item['price'], 0, ',', '.') }}</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>Rp{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</td>
                            <td>
                                <form action="{{ route('buyer.cart.remove', $id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="text-end mt-4">
            <h4>Total: <span class="text-warning">Rp{{ number_format($total, 0, ',', '.') }}</span></h4>
<a href="{{ route('buyer.checkout') }}" class="btn btn-success mt-3">
    Checkout
</a>

        </div>
    @else
        <div class="text-center py-5">
            <h5>Keranjang kamu masih kosong 😅</h5>
            <a href="{{ route('buyer.dashboard') }}" class="btn btn-primary mt-3">
                <i class="bi bi-arrow-left"></i> Belanja Sekarang
            </a>
        </div>
    @endif
</div>
@endsection

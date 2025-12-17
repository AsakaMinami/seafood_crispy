@extends('layouts.buyer')

@section('content')
<div class="container py-5 text-white">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded-4 bg-dark text-light">

                {{-- GAMBAR --}}
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}"
                         class="card-img-top"
                         style="height: 300px; object-fit: cover;">
                @endif

                {{-- INFO --}}
                <div class="card-body text-center">
                    <h3 class="fw-bold">{{ $product->name }}</h3>
                    <p class="text-secondary">{{ $product->description }}</p>
                    <p class="fw-bold fs-4 text-warning">
                        Rp{{ number_format($product->price, 0, ',', '.') }}
                    </p>

                    <a href="{{ route('buyer.dashboard') }}"
                       class="btn btn-outline-light rounded-pill mt-3">
                        ⬅ Kembali
                    </a>
                </div>

                {{-- ACTION --}}
                <div class="p-3">

                    {{-- TAMBAH KE CART --}}
                    <form action="{{ route('buyer.cart.add', $product->id) }}" method="POST">
                        @csrf
                        <button class="btn btn-primary w-100 mb-2 fw-semibold">
                            🛒 Tambah ke Keranjang
                        </button>
                    </form>

                    {{-- BELI SEKARANG --}}
                    <a href="{{ route('buyer.orders.checkout', $product->id) }}"
                       class="btn btn-warning w-100 fw-semibold">
                        ⚡ Beli Sekarang
                    </a>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection

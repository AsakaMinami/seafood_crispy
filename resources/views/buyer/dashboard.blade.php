@extends('layouts.buyer')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #0f172a, #1e1b4b);
        color: white;
        font-family: 'Poppins', sans-serif;
    }

    .dashboard-container {
        padding: 60px 20px;
        max-width: 1200px;
        margin: auto;
        text-align: center;
    }

    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 25px;
        justify-items: center;
    }

    .product-card {
        background: #1e1b4b;
        border-radius: 20px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.3);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        width: 100%;
        max-width: 300px;
    }

    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 25px rgba(0,0,0,0.4);
    }

    .product-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .product-info {
        padding: 20px;
    }

    .product-info h5 {
        margin: 0;
        font-size: 1.2rem;
        color: #fff;
        font-weight: 600;
    }

    .product-info p {
        font-size: 0.9rem;
        color: #cbd5e1;
        margin: 10px 0;
    }

    .product-info .price {
        font-size: 1rem;
        font-weight: bold;
        color: #a855f7;
        margin-bottom: 15px;
    }

    .btn-detail {
        display: inline-block;
        background: #a855f7;
        color: white;
        text-decoration: none;
        padding: 10px 20px;
        border-radius: 30px;
        font-size: 0.9rem;
        transition: 0.3s;
    }

    .btn-detail:hover {
        background: #7e22ce;
    }

    h2 {
        font-size: 1.8rem;
        font-weight: 600;
        margin-bottom: 40px;
    }
</style>

<div class="dashboard-container">
    <h2>🛍️ Daftar Produk </h2>

    <div class="product-grid">
        @forelse($products as $product)
            <div class="product-card">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-image">
                <div class="product-info">
                    <h5>{{ $product->name }}</h5>
                    <p>{{ $product->description }}</p>
                    <div class="price">Rp{{ number_format($product->price, 0, ',', '.') }}</div>
                    <a href="{{ route('buyer.products.show', $product->id) }}" class="btn-detail">
                        <i class="bi bi-eye"></i> Lihat Detail
                    </a>
                    <form action="{{ route('buyer.cart.add', $product->id) }}" method="POST" class="mt-2">
    @csrf
    <button type="submit" class="btn btn-primary btn-sm">🛒 Tambah ke Keranjang</button>
</form>

                </div>
            </div>
        @empty
            <p>Tidak ada produk yang ditemukan.</p>
        @endforelse
    </div>
</div>
@endsection

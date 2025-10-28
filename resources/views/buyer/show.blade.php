@extends('layouts.buyer')

@section('content')
<div class="container py-5 text-white">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded-4 bg-dark text-light">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" 
                         class="card-img-top" style="height: 300px; object-fit: cover;">
                @else
                    <div class="d-flex align-items-center justify-content-center bg-secondary" 
                         style="height: 300px;">No Image Available</div>
                @endif
                <div class="card-body">
                    <h3 class="fw-bold">{{ $product->name }}</h3>
                    <p class="text-secondary">{{ $product->description }}</p>
                    <p class="fw-bold text-purple fs-4">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                    <a href="{{ route('buyer.dashboard') }}" class="btn btn-outline-light rounded-pill mt-3">Kembali</a>
                </div>

                <form action="{{ route('buyer.order.store', $product->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success w-100 mt-3 fw-semibold">
                    <i class="bi bi-cart-check"></i> Beli Sekarang
                </button>
             </form>
            </div>
        </div>
    </div>
</div>
@endsection

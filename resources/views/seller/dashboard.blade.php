@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">Dashboard Penjual</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('/seller/dashboard') }}" class="text-primary text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row g-4">
        <!-- Card: Pesanan Masuk -->
        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm rounded-4" style="background-color: #17a2b8;">
                <div class="card-body text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="fw-bold mb-0">{{ $pesananMasuk ?? 0 }}</h3>
                            <p class="mb-1">Pesanan Masuk</p>
                        </div>
                        <i class="fas fa-shopping-bag fa-2x opacity-75"></i>
                    </div>
                    <a href="#" class="text-white text-decoration-none small d-inline-flex align-items-center mt-2">
                        More info <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Card: Produk -->
        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm rounded-4" style="background-color: #198754;">
                <div class="card-body text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="fw-bold mb-0">{{ $jumlahProduk ?? 0 }}</h3>
                            <p class="mb-1">Produk</p>
                        </div>
                        <i class="fas fa-boxes fa-2x opacity-75"></i>
                    </div>
                    <a href="{{ route('seller.products.index') }}" class="text-white text-decoration-none small d-inline-flex align-items-center mt-2">
                        More info <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Card: Pelanggan -->
        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm rounded-4" style="background-color: #ffc107;">
                <div class="card-body text-dark">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="fw-bold mb-0">{{ $jumlahPelanggan ?? 0 }}</h3>
                            <p class="mb-1">Pelanggan</p>
                        </div>
                        <i class="fas fa-users fa-2x opacity-75"></i>
                    </div>
                    <a href="#" class="text-dark text-decoration-none small d-inline-flex align-items-center mt-2">
                        More info <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Card: Kategori -->
        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm rounded-4" style="background-color: #dc3545;">
                <div class="card-body text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="fw-bold mb-0">{{ $jumlahKategori ?? 0 }}</h3>
                            <p class="mb-1">Kategori</p>
                        </div>
                        <i class="fas fa-list fa-2x opacity-75"></i>
                    </div>
                    <a href="#" class="text-white text-decoration-none small d-inline-flex align-items-center mt-2">
                        More info <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .card p {
        font-size: 0.9rem;
        margin-bottom: 0;
    }

    .breadcrumb-item + .breadcrumb-item::before {
        color: #6c757d;
    }
</style>
@endsection

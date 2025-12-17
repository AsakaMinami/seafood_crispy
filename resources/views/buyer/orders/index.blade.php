@extends('layouts.buyer')

@section('content')
<div class="container py-5">

    {{-- JUDUL --}}
    <div class="text-center mb-5 p-3 rounded-4 mx-auto"
         style="background: linear-gradient(135deg, #2563eb, #1e3a8a);
                color: white;
                max-width: 500px;">
        <h4 class="mb-0">Daftar Pesanan</h4>
    </div>

    <div class="row g-4 justify-content-center">

        @forelse ($orders as $order)

        {{-- CARD PESANAN --}}
        <div class="col-md-6 col-lg-4">

            <div class="p-4 rounded-4 shadow h-100"
                 style="
                    background: linear-gradient(180deg, #0f172a, #020617);
                    border: 1px solid rgba(255,255,255,0.08);
                 ">

                <div class="text-center">

                    <img src="{{ asset('storage/' . $order->product->image) }}"
                         class="img-fluid rounded mb-3"
                         style="max-width: 120px;"
                         alt="{{ $order->product->name }}">

                    <h6 class="fw-bold text-white mb-1">
                        {{ $order->product->name }}
                    </h6>

                    <p class="text-info mb-3 small">
                        Rp {{ number_format($order->product->price, 0, ',', '.') }}
                    </p>

                    <div class="text-start text-light small">
                        <p class="mb-1"><b>Nama:</b> {{ $order->nama_penerima ?? '-' }}</p>
                        <p class="mb-1"><b>Alamat:</b> {{ $order->alamat ?? '-' }}</p>
                        <p class="mb-1"><b>No HP:</b> {{ $order->no_hp ?? '-' }}</p>
                        <p class="mb-0">
                            <b>Status:</b>
                            <span class="badge 
                                @if($order->status == 'pending') bg-warning text-dark
                                @elseif($order->status == 'selesai') bg-success
                                @else bg-secondary @endif">
                                {{ ucfirst($order->status) }}
                            </span>
                        </p>
                    </div>

                </div>

            </div>

        </div>

        @empty
        <div class="text-center text-light mt-5">
            <i class="bi bi-bag-x fs-1"></i>
            <p class="mt-3">Belum ada pesanan.</p>
        </div>
        @endforelse

    </div>
</div>
@endsection

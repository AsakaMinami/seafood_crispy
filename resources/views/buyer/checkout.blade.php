@extends('layouts.buyer')

@section('content')
<div class="container py-5">
    <div class="card p-4 bg-dark text-light border-0 rounded-4">

        <h4 class="text-center mb-4">Checkout Pesanan</h4>

        {{-- INFO PRODUK --}}
        <div class="text-center mb-4">
            <img src="{{ asset('storage/' . $product->image) }}"
                 width="160" class="rounded mb-2">
            <h5>{{ $product->name }}</h5>
            <p class="text-info">
                Rp {{ number_format($product->price,0,',','.') }}
            </p>
        </div>

        {{-- FORM --}}
        <form action="{{ route('buyer.orders.confirm', $product->id) }}"
              method="POST">
            @csrf

            <div class="mb-3">
                <label>Nama Penerima</label>
                <input type="text"
                       name="nama_penerima"
                       class="form-control"
                       required>
            </div>

            <div class="mb-3">
                <label>No HP</label>
                <input type="text"
                       name="no_hp"
                       class="form-control"
                       required>
            </div>

            <div class="mb-3">
                <label>Alamat Lengkap</label>
                <textarea name="alamat"
                          class="form-control"
                          rows="2"
                          required></textarea>
            </div>
    
            {{-- KOORDINAT --}}
            <input type="hidden" name="latitude" id="lat">
            <input type="hidden" name="longitude" id="lng">

            {{-- MAP --}}
            <div class="mb-3">
                <label>Lokasi Pengantaran</label>
                <div id="map"
                     style="height:300px; border-radius:12px;"></div>
                <small class="text-warning">
                    Klik peta untuk menentukan lokasi
                </small>
            </div>

            <button class="btn btn-success w-100">
                ✅ Konfirmasi Pesanan
            </button>

        </form>
    </div>
</div>

{{-- SCRIPT MAP --}}
<script>
    var map = L.map('map').setView([-6.2, 106.8166], 13);
    var marker;

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap'
    }).addTo(map);

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(pos) {
            let lat = pos.coords.latitude;
            let lng = pos.coords.longitude;

            map.setView([lat, lng], 16);
            marker = L.marker([lat, lng]).addTo(map);

            document.getElementById('lat').value = lat;
            document.getElementById('lng').value = lng;
        });
    }

    map.on('click', function(e) {
        if (marker) marker.setLatLng(e.latlng);
        else marker = L.marker(e.latlng).addTo(map);

        document.getElementById('lat').value = e.latlng.lat;
        document.getElementById('lng').value = e.latlng.lng;
    });
</script>
@endsection

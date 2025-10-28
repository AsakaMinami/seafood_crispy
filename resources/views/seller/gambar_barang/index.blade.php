@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Halaman Gambar Barang</h2>

    {{-- Form upload gambar --}}
    <form action="{{ route('seller.gambar.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="gambar">Upload Gambar</label>
            <input type="file" name="gambar" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>

    {{-- Tampilkan gambar yang sudah diupload --}}
    <div class="row mt-4">
        @foreach($gambars as $gambar)
            <div class="col-md-3 mb-3">
                <img src="{{ asset('storage/'.$gambar->path) }}" class="img-thumbnail">
            </div>
        @endforeach
    </div>
</div>
@endsection

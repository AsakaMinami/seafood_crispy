@extends('layouts.buyer')

@section('content')
<div class="container py-5 d-flex justify-content-center align-items-center" style="min-height: 90vh;">
    <div class="card shadow-lg border-0 rounded-4 p-4" style="max-width: 600px; width: 100%; background: #ffffff;">
        <div class="text-center mb-4">
            <div class="position-relative d-inline-block">
                @if(Auth::user()->profile_picture)
                    <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" 
                        alt="Foto Profil" 
                        class="rounded-circle border border-3 border-primary shadow-sm" 
                        width="120" height="120" style="object-fit: cover;">
                @else   
                    <div class="rounded-circle border border-3 border-primary d-flex align-items-center justify-content-center" 
                         style="width: 120px; height: 120px;">
                        <i class="bi bi-person-fill text-primary" style="font-size: 3rem;"></i>
                    </div>
                @endif
            </div>
            <h3 class="fw-bold mt-3 text-primary">
                <i class="bi bi-person-circle me-2"></i>Edit Profil
            </h3>
        </div>

        <form method="POST" action="{{ route('buyer.profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('POST')

            <div class="mb-3">
                <label for="profile_photo" class="form-label fw-semibold">Foto Profil</label>
                <input type="file" class="form-control" name="profile_picture" id="profile_picture" accept="image/*">
            </div>

            <div class="mb-3">
                <label for="name" class="form-label fw-semibold">Nama</label>
                <input type="text" class="form-control" name="name" id="name" 
                       value="{{ old('name', Auth::user()->name) }}" required>
            </div>

            <div class="mb-4">
                <label for="email" class="form-label fw-semibold">Email</label>
                <input type="email" class="form-control" name="email" id="email" 
                       value="{{ old('email', Auth::user()->email) }}" required>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg rounded-3 shadow-sm fw-semibold">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    body {
        background: linear-gradient(135deg, #f0f5ff, #ffffff);
    }

    .card {
        animation: fadeInUp 0.6s ease-in-out;
    }

    @keyframes fadeInUp {
        from {
            transform: translateY(40px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    input.form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 6px rgba(13, 110, 253, 0.3);
    }

    .btn-primary:hover {
        background-color: #004ecb;
        transition: 0.3s ease;
    }
</style>
@endsection

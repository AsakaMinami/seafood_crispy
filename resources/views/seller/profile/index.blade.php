@extends('layouts.app')

@section('content')
<div class="container py-5 d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="profile-card shadow-lg border-0 rounded-4" style="max-width: 600px; width: 100%;">
        <div class="text-center p-5">

            <style>
                body {
                    background: url('{{ asset('uploads/bg_login.jpg') }}') no-repeat center center fixed;
                    background-size: cover;
                    background-attachment: fixed;
                }

                .profile-card {
                    background: rgba(255, 255, 255, 0.1) !important;
                    backdrop-filter: blur(25px);
                    -webkit-backdrop-filter: blur(15px);
                    border-radius: 20px;
                    border: 1px solid rgba(255, 255, 255, 0.3);
                    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
                    padding: 40px;
                    color: #fff;
                }

                .profile-card h3,
                .profile-card p {
                    color: #fff;
                }

                .btn-primary {
                    background-color: rgba(0, 123, 255, 0.8);
                    border: none;
                    transition: 0.3s;
                }

                .btn-primary:hover {
                    background-color: rgba(0, 123, 255, 1);
                    transform: scale(1.05);
                }

                img.rounded-circle:hover {
                    transform: scale(1.05);
                    transition: 0.3s ease;
                }
            </style>

            {{-- Foto Profil --}}
            <div class="position-relative d-inline-block mb-4">
                <img src="{{ Auth::user()->profile_picture 
                    ? asset('uploads/profile_pictures/' . Auth::user()->profile_picture) 
                    : asset('images/default-profile.png') }}" 
                    class="rounded-circle shadow-sm"
                    style="width: 120px; height: 120px; object-fit: cover; border: 4px solid #0d6efd;">
            </div>

            {{-- Info Pengguna --}}
            <h3 class="fw-bold mb-1">{{ Auth::user()->name }}</h3>
            <p><i class="fa-solid fa-envelope me-2"></i>{{ Auth::user()->email }}</p>
            <p><i class="fa-regular fa-calendar me-2"></i>Dibuat pada: {{ Auth::user()->created_at->format('d M Y') }}</p>

            {{-- Tombol Edit --}}
            <a href="{{ route('seller.profile.edit') }}" 
               class="btn btn-primary px-4 py-2 rounded-pill shadow-sm">
                <i class="fa-solid fa-pen-to-square me-2"></i>Edit Profil
            </a>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center" style="min-height: 100vh; padding-top:80px;">
    <div class="card border-0 shadow-lg p-4" 
         style="width: 100%; max-width: 450px; background: rgba(255,255,255,0.1); backdrop-filter: blur(25px); border-radius: 20px;">

        {{-- Foto Profil --}}
        <div class="text-center mb-3 position-relative">
            <form id="profileForm" action="{{ route('seller.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')

                <label for="profile_picture" class="position-relative d-inline-block" style="cursor: pointer;">
                    <img src="{{ $user->profile_picture 
                        ? asset('uploads/profile_pictures/' . $user->profile_picture)
                        : asset('images/default-profile.png') }}"
                        alt="Foto Profil" 
                        class="rounded-circle shadow-sm"
                        style="width: 110px; height: 110px; object-fit: cover; border: 3px solid #0d6efd; transition: 0.3s;">
                    <div class="overlay-icon position-absolute top-50 start-50 translate-middle"
                        style="opacity: 0; transition: 0.3s;">
                        <i class="fa-solid fa-camera fa-lg text-white"></i>
                    </div>
                </label>

                <input type="file" id="profile_picture" name="profile_picture" class="d-none" accept="image/*"
                       onchange="document.getElementById('profileForm').submit();">

                <h4 class="fw-bold text-white mt-3">Edit Profil</h4>
            </form>
        </div>

        {{-- Form --}}
        <form action="{{ route('seller.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')

            <div class="mb-2">
                <label class="form-label text-white small">Nama</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                       class="form-control bg-transparent text-white border-secondary">
            </div>

            <div class="mb-2">
                <label class="form-label text-white small">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                       class="form-control bg-transparent text-white border-secondary">
            </div>

            {{-- Password --}}
            <div class="mb-2 position-relative">
                <label class="form-label text-white small">Password (kosongkan jika tidak diubah)</label>
                <div class="position-relative">
                    <input type="password" name="password" id="password" 
                           class="form-control bg-transparent text-white border-secondary pe-5">
                    <button type="button" id="togglePassword"
                            class="btn position-absolute end-0 top-50 translate-middle-y me-2 p-0 border-0 bg-transparent">
                        <i class="fa-solid fa-eye text-white"></i>
                    </button>
                </div>
            </div>

            {{-- Konfirmasi Password --}}
            <div class="mb-3 position-relative">
                <label class="form-label text-white small">Konfirmasi Password</label>
                <div class="position-relative">
                    <input type="password" name="password_confirmation" id="confirmPassword" 
                           class="form-control bg-transparent text-white border-secondary pe-5">
                    <button type="button" id="toggleConfirmPassword"
                            class="btn position-absolute end-0 top-50 translate-middle-y me-2 p-0 border-0 bg-transparent">
                        <i class="fa-solid fa-eye text-white"></i>
                    </button>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary px-4 me-2 rounded-pill">
                    <i class="fa-solid fa-floppy-disk me-2"></i>Simpan
                </button>
                <a href="{{ url('/seller/profile') }}" class="btn btn-secondary px-4 rounded-pill">
                    <i class="fa-solid fa-xmark me-2"></i>Batal
                </a>
            </div>
        </form>
    </div>
</div>

<style>
    body {
        background: url('{{ asset('uploads/bg_login.jpg') }}') no-repeat center center fixed;
        background-size: cover;
        overflow: hidden; /* Tidak scroll */
    }
    
    /* Buat form tetap di tengah area konten (kanan dari sidebar) */
    .container {
        margin-left: auto;
    margin-right: auto;
    max-width: 450px;
    display: flex;
    justify-content: center;
    min-height: 100vh;
    padding-top: 80px; 
    }

    main {
    display: flex;
    justify-content: center;
    align-items: center;
    }


    .card {
        box-shadow: 0 8px 30px rgba(0,0,0,0.4);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: scale(1.02);
        box-shadow: 0 10px 40px rgba(0,0,0,0.5);
    }


    label[for="profile_picture"]:hover img {
        opacity: 0.7;
        transform: scale(1.05);
    }

    label[for="profile_picture"]:hover .overlay-icon {
        opacity: 1;
    }

    .btn-primary {
        background-color: rgba(13, 110, 253, 0.85);
        border: none;
        transition: 0.3s;
    }

    .btn-primary:hover {
        background-color: #0d6efd;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(13, 110, 253, 0.4);
    }
</style>

<script>
    // 👁️ Toggle visibility password
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');

    togglePassword.addEventListener('click', function () {
        const isPassword = passwordInput.type === 'password';
        passwordInput.type = isPassword ? 'text' : 'password';
        this.querySelector('i').classList.toggle('fa-eye-slash', isPassword);
        this.querySelector('i').classList.toggle('fa-eye', !isPassword);
    });

    const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
    const confirmInput = document.getElementById('confirmPassword');

    toggleConfirmPassword.addEventListener('click', function () {
        const isPassword = confirmInput.type === 'password';
        confirmInput.type = isPassword ? 'text' : 'password';
        this.querySelector('i').classList.toggle('fa-eye-slash', isPassword);
        this.querySelector('i').classList.toggle('fa-eye', !isPassword);
    });
</script>
@endsection

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Aplikasi Penjualan') }}</title>

    <script src="{{ asset('js/app.js') }}" defer></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
 
    <style>
        :root {
            --sidebar-width: 250px;
            --sidebar-bg: #212529; /* Warna gelap untuk sidebar */
            --sidebar-text: #adb5bd;
            --sidebar-active-bg: #495057;
            --navbar-height: 56px;
        }
        body {
            overflow-x: hidden;
            background-color: #f8f9fa; /* Latar belakang body terang */
        }
        #wrapper {
            display: flex;
        }
        /* Style Sidebar */
        #sidebar-wrapper {
            min-height: 100vh;
            width: var(--sidebar-width);
            background-color: var(--sidebar-bg);
            color: var(--sidebar-text);
            /* padding-top dihapus karena header digabung ke sini */
            position: fixed;
            z-index: 100;
        }
        /* Header Top Sidebar yang Menggantikan Navbar Brand */
        .sidebar-header-top {
            height: var(--navbar-height);
            display: flex;
            align-items: center;
            padding: 0 1.25rem;
            font-size: 1.2rem;
            font-weight: bold;
            color: #ffffff; 
            background-color: #212529; 
            border-bottom: 1px solid #495057; 
        }

        /* Style Navbar */
        .navbar-custom {
            background-color: #ffffff; 
            box-shadow: 0 2px 4px rgba(0,0,0,.08);
            position: fixed;
            width: 100%;
            z-index: 1000;
            margin-left: var(--sidebar-width); /* Navbar dimulai setelah sidebar */
            width: calc(100% - var(--sidebar-width)); /* Lebar disesuaikan */
        }

        /* Style Content */
        #page-content-wrapper {
            margin-left: var(--sidebar-width);
            padding-top: var(--navbar-height);
            width: 100%;
        }

        /* Nav Link Sidebar */
        .sidebar-heading {
            padding: 0.875rem 1.25rem;
            font-size: 1.1rem;
            color: #ffffff;
            font-weight: bold;
        }
        .list-group-item {
            background-color: var(--sidebar-bg);
            color: var(--sidebar-text);
            border: none;
            padding: 0.75rem 1.25rem;
            font-size: 0.95rem;
        }
        .list-group-item:hover {
            background-color: var(--sidebar-active-bg);
            color: #ffffff;
        }
        .list-group-item.active {
            background-color: var(--sidebar-active-bg) !important;
            color: #ffffff;
            border-left: 3px solid #0d6efd;
        }
        .list-group-item i {
            margin-right: 10px;
            width: 20px;
        }
    </style>
</head>
<body>
    <div id="wrapper">
        <nav class="min-h-screen flex items-center justify-center bg-cover bg-center" >
            <div class="container-fluid">
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    </ul>
                </div>
            </div>
        </nav>
        
        <div id="sidebar-wrapper">

            <div class="list-group list-group-flush">

                {{-- Daftar Menu --}}
                <!-- Bagian gambar + info seller -->
                <div class="text-center p-3 border-bottom">
                    <img src="{{ Auth::user()->profile_picture? asset('uploads/profile_pictures/' . Auth::user()->profile_picture) 
                    : asset('images/default-profile.png') }}" 
                    class="rounded-circle" alt="Profile" style="width: 80px; height: 80px; object-fit: cover;">

                    <div>
                        <a href="{{ route('seller.profile') }}" class="d-block text-decoration-none text-white mt-2">
                            <i class="fas fa-user"></i> {{ Auth::user()->name }}
                        </a>
                    </div>
               </div> 
 
                <a href="{{ url('/home') }}" class="list-group-item list-group-item-action active">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
                <a href="{{ route('seller.products.index') }}" class="list-group-item list-group-item-action">
                    <i class="fas fa-box"></i> Products
                </a>

{{-- KODE PESANAN SUDAH DIPERBAIKI --}}
        <a href="{{ route('seller.pesanan') }}" class="list-group-item list-group-item-action {{ Request::is('seller/pesanan*') ? 'active' : '' }}">
            <i class="fas fa-shopping-cart"></i> Pesanan
        </a>
                
                {{-- MENU USER HANYA UNTUK ADMIN --}}
                @if (Auth::check() && Auth::user()->role === 'admin')
                    <a href="#" class="list-group-item list-group-item-action">
                        <i class="fas fa-user"></i> User
                    </a>
                @endif
                
                {{-- TOMBOL LOG OUT --}}
                <a href="{{ route('logout') }}" class="list-group-item list-group-item-action" 
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Log Out
                </a>
            </div>
        </div>
        
        <div id="page-content-wrapper">
            <div class="container-fluid"> 
                @yield('content')
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</body>
</html>
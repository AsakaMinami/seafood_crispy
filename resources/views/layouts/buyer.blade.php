<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Buyer</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <style>
        body {
            background: linear-gradient(180deg, #111827, #1f2937);
            min-height: 100vh;
        }
        .navbar {
            background-color: #111827;
        }
        .text-purple {
            color: #a974ff;
        }
        .dropdown-menu {
    background-color: #212529;
    border: none;
}
.dropdown-item {
    color: #fff !important;
}
.dropdown-item:hover {
    background-color: #495057 !important;
}
.dropdown-divider {
    border-color: #495057;
}
    </style>
</head>
<body>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>

    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('buyer.dashboard') }}">Toko Seafood Crispy</a>

            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a href="{{ route('buyer.dashboard') }}" class="nav-link">Home</a></li>
                <li class="nav-item">
                  <a href="{{ route('buyer.cart') }}" class="nav-link">
        <i class="bi bi-cart3 me-1"></i> Keranjang
    </a>
</li>

                <li class="nav-item"><a href="{{ route('buyer.orders.index') }}" class="nav-link">Pesanan Saya</a></li>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" 
       role="button" data-bs-toggle="dropdown" aria-expanded="false">

        @if(Auth::user()->profile_picture)
            <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}"
                 alt="Profile"
                 class="rounded-circle"
                 style="width: 40px; height: 40px; object-fit: cover; border: 2px solid #fff;">
        @else
            <img src="{{ asset('images/default-profile.png') }}"
                 alt="Default Profile"
                 class="rounded-circle"
                 style="width: 40px; height: 40px; object-fit: cover; border: 2px solid #fff;">
        @endif
    </a>

    <ul class="dropdown-menu dropdown-menu-end text-small mt-2 shadow" aria-labelledby="navbarDropdown">
        <li>
            <a class="dropdown-item" href="{{ route('buyer.profile') }}">
                <i class="bi bi-person-circle me-2"></i> Profil Saya
            </a>
        </li>
        <li><hr class="dropdown-divider"></li>
        <li>
            <a class="dropdown-item text-danger" href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right me-2"></i> Logout
            </a>
        </li>
    </ul>
</li>


            </ul>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>
</body>
</html>

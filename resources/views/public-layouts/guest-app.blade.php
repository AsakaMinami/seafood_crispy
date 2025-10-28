<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Penjualan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            /* Pastikan body memenuhi seluruh layar */
            min-height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            /* Tambahkan style untuk gambar latar belakang */
            background-image: url("{{ asset('images/bg_login.jpg') }}");
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
        }

        .login-card {
            background:transparent;/* membuat transparansi */ 
            border-radius: 20px; /* Sudut membulat */
            box-shadow: 0 0 50px rgba(0,0,0,0.2); /* Bayangan */
            backdrop-filter:blur(1000px);
            width: 450px;
            max-width: 2000px;
            padding:35px; /* Menambah jarak di dalam kartu */
        }

        .card-header {
            background: transparent !important; /* Membuat header juga transparan */
            border-bottom: none !important;
            font-weight: bold;
        }

    .login-card label, .login-card h4, .login-card p, .login-card a {
        color: #ffffff; /* Mengubah warna teks menjadi putih */
        text-shadow: 1px 1px 2px rgba(0,0,0,0.5); /* Menambahkan bayangan teks untuk keterbacaan */
    }
    .login-card input {
        background-color: rgba(255, 255, 255, 0.2); /* Membuat input lebih transparan */
        border: 1px solid rgba(255, 255, 255, 0.4); /* Border input lebih terang */
        color: #ffffff; /* Mengubah warna teks input menjadi putih */
    }
    .login-card input::placeholder {
        color: rgba(255, 255, 255, 0.7); /* Mengubah warna placeholder menjadi putih transparan */
    }
        .login-card .card-header {
        color: #ffffff;
    }

    .login-card .form-check-label, .login-card .btn-link {
        font-size: 0.9rem;
    }

    </style>
</head>
<body>

<main class="py-4">
    @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
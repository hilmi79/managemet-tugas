<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome | Sistem Manajemen Tugas</title>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            scroll-behavior: smooth;
}
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.25rem;
        }
        .app-footer {
            background-color: #ffffff;
            border-top: 1px solid #dee2e6;
        }
        .navbar {
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #dee2e6;
    }


    </style>

    @stack('style')
</head>
<body class="d-flex flex-column min-vh-100">


    <!-- Navbar -->
  <nav class="navbar navbar-expand-lg fixed-top bg-white shadow-sm">
  <div class="container py-2">
    <a class="navbar-brand fw-bold" href="{{route('dashboard')}}">Sistem Tugas</a>
    <div class="d-flex">
      <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Login</a>
      <a href="{{ route('register') }}" class="btn btn-primary">Daftar</a>
    </div>
  </div>
</nav>


    <!-- Konten Utama -->
    <main class="flex-fill">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="app-footer py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <span class="text-muted small">
                &copy; {{ date('Y') }} Proyek UAS - Sistem Manajemen Tugas
            </span>
            <span class="text-muted small">Versi 1.0</span>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('script')
</body>
</html>

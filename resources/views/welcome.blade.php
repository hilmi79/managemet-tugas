@extends('layouts.guest')

@section('content')
<div class="hero-section d-flex align-items-center min-vh-100">
    <div class="container">
        <div class="row align-items-center">

            <!-- Konten Kiri -->
            <div class="col-lg-6 text-center text-lg-start animate__animated animate__fadeInLeft">
                <span class="badge bg-primary mb-3 px-3 py-2 fs-6 rounded-pill shadow-sm">
                    Sistem Informasi Akademik
                </span>
                <h1 class="display-4 fw-bold text-dark mb-4 lh-sm">
                    Selamat Datang di <br><span class="text-primary">Sistem Manajemen Tugas</span>
                </h1>
                <p class="fs-5 text-muted mb-4">
                    Platform <span class="fw-semibold">terintegrasi</span> untuk mahasiswa & dosen dalam mengelola
                    <span class="text-primary">tugas kuliah, nilai</span>, dan <span class="text-primary">mata kuliah</span> secara efisien.
                </p>
                <a href="{{ route('login') }}" class="btn btn-lg btn-primary px-4 py-2 shadow-sm">
                    <i class="bi bi-box-arrow-in-right me-2"></i> Masuk Sekarang
                </a>
            </div>

            <!-- Ilustrasi Kanan -->
            <div class="col-lg-6 mt-5 mt-lg-0 text-center animate__animated animate__fadeInRight">
                <img src="{{ asset('images/hero-illustration.svg') }}" alt="Ilustrasi Edukasi"
                     class="img-fluid rounded mx-auto" style="max-height: 420px;">
            </div>
        </div>
    </div>
</div>
@endsection

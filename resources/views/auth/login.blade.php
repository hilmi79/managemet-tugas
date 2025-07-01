@extends('layouts.guest')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center align-items-center py-5 my-5 ">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow border-0 rounded-4">
                <div class="card-body p-4">
                    <h3 class="text-center mb-4 fw-bold">Masuk</h3>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Alamat Email</label>
                            <input type="email" name="email" id="email" class="form-control" required autofocus>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Kata Sandi</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>

                        <div class="mb-3 form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label" for="remember">Ingat Saya</label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Masuk</button>

                        <div class="text-center mt-3">
                            <a href="{{ route('password.request') }}" class="text-decoration-none small text-muted">Lupa kata sandi?</a>
                        </div>

                        <hr class="my-4">

                        <div class="text-center">
                            <span class="text-muted">Belum punya akun?</span>
                            <a href="{{ route('register') }}" class="text-decoration-none">Daftar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

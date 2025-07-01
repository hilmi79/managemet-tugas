@extends('layouts.admin')

@section('title', 'Profil Pengguna')

@section('content')
<div class="container mb-5">
    <h4 class="fw-bold mb-4">Profil Pengguna</h4>

    {{-- Form: Update Profile Information --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            @include('profile.partials.update-profile-information-form')
        </div>
    </div>

    {{-- Form: Update Password --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            @include('profile.partials.update-password-form')
        </div>
    </div>

    {{-- Form: Delete User --}}
    <div class="card shadow-sm">
        <div class="card-body">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if (session('status') === 'profile-updated')
            Swal.fire({
                icon: 'success',
                title: 'Profil Diperbarui!',
                text: 'Informasi akun kamu berhasil diperbarui.',
                timer: 2500,
                showConfirmButton: false
            });
        @endif
    });
</script>
@endpush


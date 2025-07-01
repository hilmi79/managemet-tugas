<div class="card shadow-sm mb-4">
    <div class="card-header">
        <h5 class="mb-0">Informasi Profil</h5>
        <small class="text-muted">Perbarui informasi akun dan alamat email kamu.</small>
    </div>

    {{-- Form Kirim Ulang Verifikasi Email --}}
    <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
        @csrf
    </form>

    {{-- Form Update Profil --}}
    <form method="POST" action="{{ route('profile.update') }}" class="card-body">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email">
            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2 text-muted small">
                    Alamat email kamu belum diverifikasi.
                    <button type="submit" form="send-verification" class="btn btn-link btn-sm p-0 ms-1 align-baseline">
                        Kirim ulang verifikasi
                    </button>
                </div>

                @if (session('status') === 'verification-link-sent')
                    <div class="mt-2 text-success small">
                        Link verifikasi baru telah dikirim ke email kamu.
                    </div>
                @endif
            @endif
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save me-1"></i> Simpan
            </button>

            @if (session('status') === 'profile-updated')
                <div class="text-success small">
                    <i class="bi bi-check-circle me-1"></i> Profil berhasil diperbarui.
                </div>
            @endif
        </div>
    </form>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-header">
        <h5 class="mb-0">Perbarui Kata Sandi</h5>
        <small class="text-muted">Pastikan kata sandi baru cukup panjang dan sulit ditebak.</small>
    </div>

    <form method="POST" action="{{ route('password.update') }}" class="card-body">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="current_password" class="form-label">Kata Sandi Saat Ini</label>
            <input type="password" name="current_password" id="current_password" class="form-control" autocomplete="current-password">
            @error('current_password', 'updatePassword')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Kata Sandi Baru</label>
            <input type="password" name="password" id="password" class="form-control" autocomplete="new-password">
            @error('password', 'updatePassword')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi Baru</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" autocomplete="new-password">
            @error('password_confirmation', 'updatePassword')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save me-1"></i> Simpan
            </button>

            @if (session('status') === 'password-updated')
                <div class="text-success small">
                    <i class="bi bi-check-circle me-1"></i> Kata sandi berhasil diperbarui.
                </div>
            @endif
        </div>
    </form>
</div>

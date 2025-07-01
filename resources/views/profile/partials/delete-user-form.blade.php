<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h5 class="card-title text-danger fw-bold">Hapus Akun,</h5>
        <p class="text-muted">
            Setelah akun Anda dihapus, semua data akan dihapus secara permanen. Pastikan Anda telah mencadangkan data yang ingin disimpan.
        </p>

        <!-- Tombol Trigger Modal -->
        <button class="btn btn-danger mt-2" data-bs-toggle="modal" data-bs-target="#modalHapusAkun">
            <i class="bi bi-trash3 me-1"></i> Hapus Akun
        </button>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="modalHapusAkun" tabindex="-1" aria-labelledby="modalHapusAkunLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('profile.destroy') }}" class="modal-content">
            @csrf
            @method('DELETE')

            <div class="modal-header">
                <h5 class="modal-title text-danger" id="modalHapusAkunLabel">Konfirmasi Penghapusan Akun</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <p>Apakah kamu yakin ingin menghapus akun ini? Semua data akan hilang secara permanen.</p>
                <div class="mb-3">
                    <label for="password" class="form-label">Kata Sandi</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan kata sandi" required>
                    @error('password', 'userDeletion')
                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-danger">Hapus Akun</button>
            </div>
        </form>
    </div>
</div>

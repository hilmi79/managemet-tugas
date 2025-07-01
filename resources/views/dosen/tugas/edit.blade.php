@extends('layouts.admin')

@section('content')
<div class="container mb-5">
    <h4 class="fw-bold mb-4 d-flex align-items-center gap-2">
        <i class="bi bi-pencil-square text-primary fs-4"></i>
        Edit Tugas
    </h4>

    <form action="{{ route('dosen.tugas.update', $tugas->id) }}" method="POST" enctype="multipart/form-data"
          class="card border-0 shadow-sm p-4 bg-white rounded-3">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="judul" class="form-label fw-semibold">
                <i class="bi bi-journal-text me-2 text-secondary"></i> Judul Tugas
            </label>
            <input type="text" name="judul" id="judul" class="form-control"
                   value="{{ old('judul', $tugas->judul) }}" required placeholder="Masukkan judul tugas">
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label fw-semibold">
                <i class="bi bi-card-text me-2 text-secondary"></i> Deskripsi
            </label>
            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4" required
                      placeholder="Tulis deskripsi tugas">{{ old('deskripsi', $tugas->deskripsi) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="deadline" class="form-label fw-semibold">
                <i class="bi bi-calendar-event me-2 text-secondary"></i> Deadline
            </label>
            <input type="datetime-local" name="deadline" id="deadline" class="form-control"
                   value="{{ old('deadline', \Carbon\Carbon::parse($tugas->deadline)->format('Y-m-d\TH:i')) }}"
                   required>
        </div>

        <div class="mb-4">
            <label for="file_tugas" class="form-label fw-semibold">
                <i class="bi bi-upload me-2 text-secondary"></i> Ganti File Tugas (opsional)
            </label>
            <input type="file" name="file_tugas" class="form-control">
            @if($tugas->file_tugas)
                <div class="mt-2">
                    <a href="{{ route('download.tugas', basename($tugas->file_tugas)) }}" class="text-decoration-none">
                        <i class="bi bi-file-earmark-arrow-down me-1"></i> File Saat Ini
                    </a>
                </div>
            @endif
        </div>

        {{-- Tombol --}}
        <div class="d-flex justify-content-between flex-column flex-sm-row gap-2">
            <a href="{{ route('dosen.tugas.index') }}" class="btn btn-outline-secondary w-100 w-sm-auto">
                <i class="bi bi-arrow-left-circle me-1"></i> Batal
            </a>
            <button type="submit" class="btn btn-success w-100 w-sm-auto">
                <i class="bi bi-save me-1"></i> Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection

@extends('layouts.admin')

@section('content')
<div class="container mb-5">

    <h4 class="fw-bold mb-4 d-flex align-items-center gap-2">
        <i class="bi bi-award-fill text-primary fs-4"></i>
        Nilai Jawaban Mahasiswa
    </h4>

    {{-- Card Info Mahasiswa & Tugas --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body d-flex flex-column flex-md-row justify-content-between align-items-start gap-3">
            <div>
                <p class="mb-1">
                    <i class="bi bi-person-circle me-2 text-secondary"></i>
                    <strong>Mahasiswa:</strong> {{ $jawaban->mahasiswa->name }}
                </p>
                <p class="mb-2">
                    <i class="bi bi-journal-text me-2 text-secondary"></i>
                    <strong>Judul Tugas:</strong> {{ $jawaban->tugas->judul }}
                </p>
            </div>
            <div>
                <a href="{{ route('download.jawaban', basename($jawaban->file_jawaban)) }}"
                   class="btn btn-sm btn-outline-primary">
                    <i class="bi bi-download me-1"></i> Download Jawaban
                </a>
            </div>
        </div>
    </div>

    {{-- Form Penilaian --}}
    <form action="{{ route('dosen.penilaian.update', $jawaban->id) }}" method="POST"
          class="card border-0 shadow-sm p-4 bg-white">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nilai" class="form-label fw-semibold">
                <i class="bi bi-123 me-2 text-secondary"></i> Nilai <span class="text-danger">*</span>
            </label>
            <input type="number" name="nilai" id="nilai" class="form-control" placeholder="Masukkan nilai (0-100)"
                   value="{{ $jawaban->nilai }}" min="0" max="100" required>
        </div>

        <div class="mb-4">
            <label for="komentar" class="form-label fw-semibold">
                <i class="bi bi-chat-text me-2 text-secondary"></i> Komentar
            </label>
            <textarea name="komentar" id="komentar" class="form-control" rows="4"
                      placeholder="Tulis komentar penilaian">{{ $jawaban->komentar }}</textarea>
        </div>

        {{-- Tombol Aksi --}}
        <div class="d-flex justify-content-between flex-column flex-sm-row gap-2">
            <a href="{{ route('dosen.penilaian.index') }}" class="btn btn-outline-secondary w-100 w-sm-auto">
                <i class="bi bi-arrow-left-circle me-1"></i> Batal
            </a>
            <button type="submit" class="btn btn-success w-100 w-sm-auto">
                <i class="bi bi-check-circle me-1"></i> Simpan Penilaian
            </button>
        </div>
    </form>
</div>
@endsection

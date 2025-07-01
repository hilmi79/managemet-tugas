@extends('layouts.admin')

@section('content')
<div class="container mb-5">
    {{-- Header --}}
    <div class="d-flex align-items-center gap-2 mb-4">
        <i class="bi bi-upload fs-4 text-success"></i>
        <h4 class="fw-bold mb-0">Kumpulkan Jawaban Tugas</h4>
    </div>

    {{-- Informasi Tugas --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <h5 class="fw-semibold mb-2">{{ $tugas->judul }}</h5>
            <p class="mb-2">{{ $tugas->deskripsi }}</p>
            <p class="mb-3 text-muted">
                <i class="bi bi-clock me-1"></i>
                <strong>Deadline:</strong> {{ \Carbon\Carbon::parse($tugas->deadline)->translatedFormat('d F Y H:i') }}
            </p>
            @if ($tugas->file_tugas)
                <a href="{{ route('download.tugas', basename($tugas->file_tugas)) }}" class="btn btn-sm btn-outline-primary">
                    <i class="bi bi-download me-1"></i> Download Tugas
                </a>
            @endif
        </div>
    </div>

    {{-- Form Pengumpulan Jawaban --}}
    <form action="{{ route('mahasiswa.jawaban.store') }}" method="POST" enctype="multipart/form-data" class="card border-0 shadow-sm p-4 bg-white">
        @csrf
        <input type="hidden" name="tugas_id" value="{{ $tugas->id }}">

        <div class="mb-3">
            <label for="file_jawaban" class="form-label fw-semibold">
                <i class="bi bi-file-earmark-arrow-up me-1 text-secondary"></i> Upload File Jawaban
            </label>
            <input type="file" class="form-control shadow-sm" name="file_jawaban" id="file_jawaban" required>
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-success px-4">
                <i class="bi bi-send-check me-1"></i> Kumpulkan Jawaban
            </button>
        </div>
    </form>
</div>
@endsection

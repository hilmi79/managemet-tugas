@extends('layouts.admin')

@section('content')
<div class="container mb-5">

    {{-- Header --}}
    <div class="d-flex align-items-center gap-2 mb-4">
        <i class="bi bi-pencil-square fs-4 text-warning"></i>
        <h4 class="fw-bold mb-0">Revisi Jawaban</h4>
    </div>

    {{-- Informasi Tugas --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <h5 class="fw-semibold mb-0">
                <i class="bi bi-journal-text me-1 text-secondary"></i> {{ $jawaban->tugas->judul }}
            </h5>
        </div>
    </div>

    {{-- Form Revisi Jawaban --}}
    <form action="{{ route('mahasiswa.jawaban.update', $jawaban->id) }}" method="POST" enctype="multipart/form-data" class="card border-0 shadow-sm p-4 bg-white">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="file_jawaban" class="form-label fw-semibold">
                <i class="bi bi-upload me-1 text-secondary"></i> Upload Ulang Jawaban
            </label>
            <input type="file" class="form-control shadow-sm" name="file_jawaban" id="file_jawaban" required>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('mahasiswa.tugas.index') }}" class="btn btn-outline-secondary px-4">
                <i class="bi bi-arrow-left-circle me-1"></i> Batal
            </a>
            <button type="submit" class="btn btn-success px-4">
                <i class="bi bi-send-check me-1"></i> Upload Revisi
            </button>
        </div>
    </form>

</div>
@endsection

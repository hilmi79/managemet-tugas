@extends('layouts.admin')
@section('title', 'Detail Tugas')

@section('content')
<div class="container mb-5">
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <h4 class="fw-bold mb-3">{{ $tugas->judul }}</h4>

            <ul class="list-unstyled mb-4">
                <li><i class="bi bi-book me-2"></i><strong>Mata Kuliah:</strong> {{ $tugas->matakuliah->nama ?? '-' }}</li>
                <li><i class="bi bi-card-text me-2"></i><strong>Deskripsi:</strong> {{ $tugas->deskripsi }}</li>
                <li><i class="bi bi-calendar-event me-2"></i><strong>Deadline:</strong>
                    {{ \Carbon\Carbon::parse($tugas->deadline)->translatedFormat('d F Y H:i') }}
                </li>
                @if ($tugas->file_tugas)
                    <li class="mt-2">
                        <i class="bi bi-file-earmark-arrow-down me-2"></i>
                        <a href="{{ route('download.tugas', basename($tugas->file_tugas)) }}" class="text-decoration-none">
                            Download File Tugas
                        </a>
                    </li>
                @endif
            </ul>

            @if($pengumpulan)
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    Kamu sudah mengumpulkan tugas ini.
                </div>
            @else
                <a href="{{ route('mahasiswa.jawaban.create', $tugas->id) }}" class="btn btn-success px-4">
                    <i class="bi bi-upload me-1"></i> Kumpulkan Tugas
                </a>
            @endif
        </div>
    </div>
</div>
@endsection

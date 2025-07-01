@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">

 {{-- HEADER --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-2">
        <div>
            <h3 class="mb-0 fw-bold">Hai, {{ Auth::user()->name }}</h3>
            <p class="text-muted mb-0">{{ now()->translatedFormat('l, d F Y') }}</p>
        </div>
        @if(Auth::user()->role === 'dosen')
        <div class="d-flex gap-2">
            <a href="{{ route('dosen.tugas.create') }}" class="btn btn-outline-primary">
                <i class="bi bi-plus-circle me-1"></i> Buat Tugas
            </a>
            <a href="{{ route('dosen.penilaian.index') }}" class="btn btn-outline-success">
                <i class="bi bi-star me-1"></i> Penilaian
            </a>
        </div>
        @endif
    </div>

    {{-- STAT CARDS --}}
    <div class="row g-3">
        @foreach($cards as $card)
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="fw-semibold mb-1">{{ $card['title'] }}</h6>
                        <h4 class="fw-bold mb-0">{{ $card['value'] }}</h4>
                        @if(isset($card['trend']))
                        <small class="text-muted">{{ $card['trend'] }}</small>
                        @endif
                    </div>
                    <div class="fs-1 text-{{ $card['color'] }}">
                        <i class="bi {{ $card['icon'] }}"></i>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

   {{-- DOSEN: JAWABAN BELUM DINILAI --}}
@if(Auth::user()->role === 'dosen')
<div class="row g-4 mt-4">
    {{-- Jawaban Belum Dinilai --}}
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white fw-semibold d-flex align-items-center">
                <i class="bi bi-exclamation-circle-fill text-danger me-2 fs-5"></i>
                <span>Jawaban Belum Dinilai</span>
            </div>
            <ul class="list-group list-group-flush">
                @forelse($data['belumDinilai'] ?? [] as $jawaban)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong>{{ $jawaban->user->name }}</strong>
                        <div class="small text-muted">{{ $jawaban->tugas->judul }}</div>
                    </div>
                    <a href="{{ route('dosen.penilaian.edit', $jawaban->id) }}" class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-pencil me-1"></i> Nilai
                    </a>
                </li>
                @empty
                <li class="list-group-item text-muted text-center">Tidak ada jawaban menunggu penilaian.</li>
                @endforelse
            </ul>
        </div>
    </div>

    {{-- Tugas Terbaru Dibuat --}}
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white fw-semibold d-flex align-items-center">
                <i class="bi bi-journal-text me-2 text-info fs-5"></i>
                <span>Tugas Terbaru Dibuat</span>
            </div>
            <ul class="list-group list-group-flush">
                @forelse($data['tugasTerbaruDosen'] ?? [] as $tugas)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong>{{ $tugas->judul }}</strong>
                        <div class="small text-muted">{{ $tugas->created_at->diffForHumans() }}</div>
                    </div>
                    <span class="badge bg-primary">{{ $tugas->matakuliah->nama ?? '-' }}</span>
                </li>
                @empty
                <li class="list-group-item text-muted text-center">Belum ada tugas dibuat.</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>

{{-- Mahasiswa Terlambat Kumpul --}}
<div class="row g-4 mt-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white fw-semibold d-flex align-items-center">
                <i class="bi bi-hourglass-split me-2 text-warning fs-5"></i>
                <span>Mahasiswa Terlambat Kumpul</span>
            </div>
            <ul class="list-group list-group-flush">
                @forelse($data['terlambatKumpul'] ?? [] as $item)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong>{{ $item->user->name }}</strong><br>
                        <small class="text-muted">{{ $item->tugas->judul }}</small>
                    </div>
                    <span class="badge bg-danger">Terlambat</span>
                </li>
                @empty
                <li class="list-group-item text-muted text-center">Tidak ada yang terlambat.</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
@endif


{{-- MAHASISWA: PROGRESS DAN NILAI --}}
    @if(Auth::user()->role === 'mahasiswa')
    <div class="row g-4 mt-4">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white fw-semibold">
                    <i class="bi bi-graph-up me-2 text-primary"></i> Progress Penyelesaian
                </div>
                <div class="card-body">
                    <p>Tugas selesai: {{ $data['tugasDikerjakan'] ?? 0 }} dari {{ $data['totalTugas'] ?? 0 }}</p>
                    <div class="progress mb-2" style="height: 14px;">
                        <div class="progress-bar bg-primary" style="width: {{ $data['progress'] ?? 0 }}%" role="progressbar">
                            {{ $data['progress'] ?? 0 }}%
                        </div>
                    </div>
                    <small class="text-muted">Selesaikan semua tugas tepat waktu </small>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white fw-semibold">
                    <i class="bi bi-award-fill text-warning me-2"></i> Nilai Terbaru
                </div>
                <ul class="list-group list-group-flush">
                    @forelse($data['nilaiTerbaru'] ?? [] as $item)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong>{{ $item->tugas->judul ?? '-' }}</strong>
                            <div class="small text-muted">{{ $item->updated_at->diffForHumans() }}</div>
                        </div>
                        <span class="badge bg-success rounded-pill">{{ $item->nilai }}</span>
                    </li>
                    @empty
                    <li class="list-group-item text-muted text-center">Belum ada nilai.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
    @endif

    {{-- MAHASISWA: TUGAS TERBARU --}}
    @if(Auth::user()->role === 'mahasiswa')
    <div class="row g-4 mt-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white fw-semibold">
                    <i class="bi bi-clock-history text-primary me-2"></i> Tugas Terbaru
                </div>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Judul</th>
                                <th>Mata Kuliah</th>
                                <th>Deadline</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $mahasiswaId = Auth::id(); @endphp
                            @forelse($data['tugasTerbaru'] ?? [] as $tugas)
                            @php
                                $isSubmitted = \App\Models\PengumpulanTugas::where('tugas_id', $tugas->id)
                                    ->where('mahasiswa_id', $mahasiswaId)
                                    ->exists();
                                $status = $isSubmitted
                                    ? ['text' => 'Terkirim', 'class' => 'success']
                                    : (now()->gt($tugas->deadline)
                                        ? ['text' => 'Terlambat', 'class' => 'danger']
                                        : ['text' => 'Belum Dikerjakan', 'class' => 'warning']);
                            @endphp
                            <tr>
                                <td>
                                    <strong>{{ $tugas->judul }}</strong>
                                    <div class="text-muted small">{{ Str::limit($tugas->deskripsi, 30) }}</div>
                                </td>
                                <td>{{ $tugas->matakuliah->nama ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($tugas->deadline)->translatedFormat('d M Y') }}</td>
                                <td>
                                    <span class="badge bg-{{ $status['class'] }}">{{ $status['text'] }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('mahasiswa.tugas.show', $tugas->id) }}" class="btn btn-sm btn-outline-primary">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">Belum ada tugas.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- MAHASISWA: TUGAS MENDEKATI DEADLINE --}}
    <div class="row g-4 mt-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white fw-semibold d-flex align-items-center">
                    <i class="bi bi-hourglass-split text-danger me-2 fs-5"></i>
                    <span>Tugas Mendekati Deadline</span>
                </div>
                <ul class="list-group list-group-flush">
                    @forelse($data['tugasDeadlineDekat'] ?? [] as $tugas)
                    <li class="list-group-item d-flex justify-content-between align-items-start flex-column flex-md-row">
                        <div class="me-3">
                            <strong class="d-block">{{ $tugas->judul }}</strong>
                            <small class="text-muted d-block">{{ $tugas->matakuliah->nama ?? '-' }}</small>
                            <small class="text-danger">Deadline: {{ \Carbon\Carbon::parse($tugas->deadline)->diffForHumans() }}</small>
                        </div>
                        <div class="mt-2 mt-md-0">
                            <a href="{{ route('mahasiswa.tugas.show', $tugas->id) }}" class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-pencil-square me-1"></i> Kerjakan
                            </a>
                        </div>
                    </li>
                    @empty
                    <li class="list-group-item text-center text-muted">
                        Tidak ada tugas yang mendekati deadline.
                    </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
    @endif

</div>
@endsection

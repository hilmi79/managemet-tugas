@extends('layouts.admin')

@section('content')
<div class="container mb-5">
    <h4 class="fw-bold mb-4">Buat Tugas Baru</h4>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <form action="{{ route('dosen.tugas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Judul Tugas --}}
                <div class="form-floating mb-3">
                    <input type="text" name="judul" id="judul" class="form-control" placeholder="Judul Tugas" required>
                    <label for="judul"><i class="bi bi-journal-text me-1"></i> Judul Tugas</label>
                </div>

                {{-- Mata Kuliah --}}
                <div class="form-floating mb-3">
                    <select name="matakuliah_id" id="matakuliah_id" class="form-select" required>
                        <option disabled selected value="">-- Pilih Mata Kuliah --</option>
                        @foreach($matakuliahList as $matkul)
                            <option value="{{ $matkul->id }}">{{ $matkul->nama }}</option>
                        @endforeach
                    </select>
                    <label for="matakuliah_id"><i class="bi bi-book me-1"></i> Mata Kuliah</label>
                </div>

                {{-- Deskripsi --}}
                <div class="form-floating mb-3">
                    <textarea name="deskripsi" id="deskripsi" class="form-control" placeholder="Deskripsi tugas" style="height: 130px;"></textarea>
                    <label for="deskripsi"><i class="bi bi-chat-text me-1"></i> Deskripsi (opsional)</label>
                </div>

                {{-- Deadline --}}
                <div class="form-floating mb-3">
                    <input type="datetime-local" name="deadline" id="deadline" class="form-control" required>
                    <label for="deadline"><i class="bi bi-clock me-1"></i> Deadline</label>
                </div>

                {{-- Upload File --}}
                <div class="mb-4">
                    <label for="file_tugas" class="form-label fw-semibold"><i class="bi bi-upload me-1"></i> Upload File</label>
                    <input type="file" name="file_tugas" id="file_tugas" class="form-control" required>
                </div>

                {{-- Tombol Aksi --}}
                <div class="d-flex justify-content-between">
                    <a href="{{ route('dosen.tugas.index') }}" class="btn btn-outline-secondary px-4">
                        <i class="bi bi-arrow-left me-1"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-save me-1"></i> Simpan Tugas
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@extends('layouts.admin')

@section('content')
<div class="container mb-5">
    {{-- Judul Halaman --}}
    <div class="d-flex align-items-center gap-2 mb-4">
        <i class="bi bi-journal-plus fs-4 text-primary"></i>
        <h4 class="fw-bold mb-0">Tambah Mata Kuliah</h4>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <form action="{{ route('dosen.matakuliah.store') }}" method="POST">
                @csrf

                {{-- Input Dosen --}}
                <div class="mb-3">
                    <label for="dosen" class="form-label fw-semibold">
                        <i class="bi bi-person-circle me-1 text-secondary"></i> Nama Dosen
                    </label>
                    <input type="text" name="dosen" id="dosen" class="form-control shadow-sm"
                           placeholder="Masukkan nama dosen" required>
                </div>

                {{-- Input Nama Mata Kuliah --}}
                <div class="mb-3">
                    <label for="nama" class="form-label fw-semibold">
                        <i class="bi bi-book-half me-1 text-secondary"></i> Nama Mata Kuliah
                    </label>
                    <input type="text" name="nama" id="nama" class="form-control shadow-sm"
                           placeholder="Masukkan nama mata kuliah" required>
                </div>

                {{-- Input Kode MK --}}
                <div class="mb-3">
                    <label for="kode" class="form-label fw-semibold">
                        <i class="bi bi-upc-scan me-1 text-secondary"></i> Kode Mata Kuliah
                    </label>
                    <input type="text" name="kode" id="kode" class="form-control shadow-sm"
                           placeholder="Masukkan kode mata kuliah" required>
                </div>

                {{-- Select Semester --}}
                <div class="mb-4">
                    <label for="semester" class="form-label fw-semibold">
                        <i class="bi bi-calendar3 me-1 text-secondary"></i> Semester
                    </label>
                    <select name="semester" id="semester" class="form-select shadow-sm" required>
                        <option disabled selected>-- Pilih Semester --</option>
                        @for($i = 1; $i <= 8; $i++)
                            <option value="Semester {{ $i }}">Semester {{ $i }}</option>
                        @endfor
                    </select>
                </div>

                {{-- Tombol Aksi --}}
                <div class="d-flex justify-content-between flex-column flex-sm-row gap-2">
                    <a href="{{ route('dosen.matakuliah.index') }}" class="btn btn-outline-secondary w-100 w-sm-auto">
                        <i class="bi bi-arrow-left-circle me-1"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary w-100 w-sm-auto">
                        <i class="bi bi-save2 me-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

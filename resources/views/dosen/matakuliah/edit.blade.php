@extends('layouts.admin')

@section('content')
<div class="container mb-5">
    <h4 class="fw-bold mb-4 d-flex align-items-center gap-2">
        <i class="bi bi-pencil-square text-primary fs-4"></i>
        Edit Mata Kuliah
    </h4>

    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <form action="{{ route('dosen.matakuliah.update', $matakuliah->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Dosen --}}
                <div class="mb-3">
                    <label for="dosen" class="form-label fw-semibold">
                        <i class="bi bi-person-circle me-2 text-secondary"></i> Nama Dosen
                    </label>
                    <input type="text" name="dosen" id="dosen" class="form-control"
                           value="{{ old('dosen', $matakuliah->dosen) }}" required placeholder="Masukkan nama dosen">
                    @error('dosen')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Nama MK --}}
                <div class="mb-3">
                    <label for="nama" class="form-label fw-semibold">
                        <i class="bi bi-journal-text me-2 text-secondary"></i> Nama Mata Kuliah
                    </label>
                    <input type="text" name="nama" id="nama" class="form-control"
                           value="{{ old('nama', $matakuliah->nama) }}" required placeholder="Masukkan nama mata kuliah">
                    @error('nama')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Kode MK --}}
                <div class="mb-3">
                    <label for="kode" class="form-label fw-semibold">
                        <i class="bi bi-code-slash me-2 text-secondary"></i> Kode Mata Kuliah
                    </label>
                    <input type="text" name="kode" id="kode" class="form-control"
                           value="{{ old('kode', $matakuliah->kode) }}" required placeholder="Masukkan kode mata kuliah">
                    @error('kode')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Semester --}}
                <div class="mb-4">
                    <label for="semester" class="form-label fw-semibold">
                        <i class="bi bi-calendar3 me-2 text-secondary"></i> Semester
                    </label>
                    <select name="semester" id="semester" class="form-select" required>
                        <option disabled>-- Pilih Semester --</option>
                        @for ($i = 1; $i <= 8; $i++)
                            <option value="Semester {{ $i }}"
                                {{ old('semester', $matakuliah->semester) == "Semester $i" ? 'selected' : '' }}>
                                Semester {{ $i }}
                            </option>
                        @endfor
                    </select>
                    @error('semester')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tombol Aksi --}}
                <div class="d-flex justify-content-between flex-column flex-sm-row gap-2">
                    <a href="{{ route('dosen.matakuliah.index') }}" class="btn btn-outline-secondary w-100 w-sm-auto">
                        <i class="bi bi-arrow-left-circle me-1"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-success w-100 w-sm-auto">
                        <i class="bi bi-save me-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

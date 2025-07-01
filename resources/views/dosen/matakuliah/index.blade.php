@extends('layouts.admin')

@section('content')
<div class="container mb-5">

    {{-- Header: Judul + Tombol Tambah --}}
<div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center mb-4 gap-2">
    <h4 class="fw-bold mb-0">Daftar Mata Kuliah</h4>
    <a href="{{ route('dosen.matakuliah.create') }}"
   class="btn btn-primary shadow-sm py-2 text-nowrap w-100 w-sm-auto text-center"
   style="max-width: 200px;">
    <i class="bi bi-plus-circle me-1"></i>
    <span class="d-none d-md-inline">Tambah Mata Kuliah</span>
    <span class="d-inline d-md-none">Tambah</span>
</a>
</div>



    {{-- Filter Semester --}}
    <form method="GET" class="mb-4">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-4">
                <select name="semester" class="form-select shadow-sm" onchange="this.form.submit()">
                    <option value="">-- Semua Semester --</option>
                    @foreach ($semesters as $semester)
                        <option value="{{ $semester }}" {{ $semesterFilter == $semester ? 'selected' : '' }}>
                            {{ $semester }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </form>

    {{-- Tabel Data --}}
    <div class="table-responsive rounded shadow-sm border p-3">
        <table id="matakuliahTable" class="table table-striped table-hover align-middle text-center w-100">
            <thead class="table-primary text-uppercase">
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 15%;">Kode MK</th>
                    <th class="text-start" style="width: 30%;">Nama Mata Kuliah</th>
                    <th style="width: 20%;">Dosen</th>
                    <th style="width: 10%;">Semester</th>
                    <th style="width: 20%;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($matakuliah as $i => $matkul)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $matkul->kode }}</td>
                        <td class="text-start">{{ $matkul->nama }}</td>
                        <td>{{ $matkul->dosen ?? '-' }}</td>
                        <td>{{ $matkul->semester }}</td>
                        <td>
                            <a href="{{ route('dosen.matakuliah.edit', $matkul->id) }}"
                               class="btn btn-sm btn-outline-warning me-2" title="Edit" data-bs-toggle="tooltip">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('dosen.matakuliah.destroy', $matkul->id) }}" method="POST" class="d-inline delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-outline-danger btn-delete" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-muted text-center">Belum ada data.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('style')
<style>
    .dataTables_filter {
        margin-bottom: 1rem;
    }
    .dataTables_paginate {
        margin: 1rem 0;
    }
</style>
@endpush

@push('script')
<script>
    $(document).ready(function () {
        $('#matakuliahTable').DataTable({
            responsive: true,
            pageLength: 10,
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data per halaman",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                paginate: {
                    first: "Awal",
                    last: "Akhir",
                    next: "›",
                    previous: "‹"
                },
                zeroRecords: "Data tidak ditemukan",
                infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                infoFiltered: "(disaring dari _MAX_ total data)"
            }
        });

        // Aktifkan Tooltip
        const tooltipList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipList.map(function (el) {
            return new bootstrap.Tooltip(el);
        });

    });
</script>
@endpush

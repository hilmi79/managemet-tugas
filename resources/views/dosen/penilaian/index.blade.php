@extends('layouts.admin')

@section('content')
<div class="container mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <h4 class="fw-bold mb-0">Jawaban Mahasiswa Belum Dinilai</h4>
    </div>

    <div class="table-responsive rounded shadow-sm border p-3">
        <table id="jawabanTable" class="table table-striped table-hover align-middle text-center" style="width:100%">
            <thead class="table-primary text-uppercase">
                <tr>
                    <th style="width: 20%;">Mahasiswa</th>
                    <th style="width: 20%;">Judul Tugas</th>
                    <th style="width: 10%;">Jawaban</th>
                    <th style="width: 25%;">Komentar</th>
                    <th style="width: 15%;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pengumpulan as $item)
                    <tr>
                        <td class="text-start">{{ $item->mahasiswa->name }}</td>
                        <td class="text-start">{{ $item->tugas->judul }}</td>
                        <td>
                            @if ($item->file_jawaban)
                            <a href="{{ route('download.jawaban', basename($item->file_jawaban)) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-download"></i>
                            </a>
                            @else
                            <span class="text-muted">Tidak ada</span>
                            @endif
                        </td>
                        <td class="text-start">{{ $item->komentar ?? '-' }}</td>
                        <td>
                            <a href="{{ route('dosen.penilaian.edit', $item->id) }}"
                               class="btn btn-sm btn-outline-warning"
                               title="Nilai"
                               data-bs-toggle="tooltip">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Semua jawaban sudah dinilai 🥰</td>
                    </tr>
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
        $('#jawabanTable').DataTable({
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
                zeroRecords: "Tidak ada data ditemukan",
                infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                infoFiltered: "(disaring dari _MAX_ total data)"
            }
        });

        const tooltipList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        tooltipList.map(function (el) {
            return new bootstrap.Tooltip(el)
        });
    });
</script>
@endpush

@extends('layouts.admin')

@section('content')
<div class="container mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <h4 class="fw-bold mb-0" style="line-height: 1.5;">Daftar Tugas Saya</h4>
        <a href="{{ route('dosen.tugas.create') }}" class="btn btn-primary px-3 py-2 shadow-sm" style="min-width: 160px;">
            <i class="bi bi-plus-circle me-1"></i> Buat Tugas Baru
        </a>
    </div>

    <div class="table-responsive rounded shadow-sm border p-3">
        <table id="tugasTable" class="table table-striped table-hover align-middle text-center" style="width:100%">
            <thead class="table-primary text-uppercase">
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 25%;">Judul</th>
                    <th>Deskripsi</th>
                    <th style="width: 15%;">Deadline</th>
                    <th style="width: 10%;">File</th>
                    <th style="width: 15%;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tugas as $i => $item)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td class="text-start">{{ $item->judul }}</td>
                        <td class="text-start">{{ Str::limit($item->deskripsi, 80) }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->deadline)->translatedFormat('d F Y H:i') }}</td>
                        <td>
                            @if ($item->file_tugas)
                                <a href="{{ route('download.tugas', basename($item->file_tugas)) }}" class="text-decoration-none">
                                    <i class="bi bi-download me-1"></i> Unduh
                                </a>
                            @else
                                <span class="text-muted">Tidak ada</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('dosen.tugas.edit', $item->id) }}"
                               class="btn btn-sm btn-outline-warning me-2"
                               title="Edit"
                               data-bs-toggle="tooltip">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('dosen.tugas.destroy', $item->id) }}" method="POST" class="d-inline delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-outline-danger btn-delete" title="Hapus" data-bs-toggle="tooltip">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-muted text-center">Belum ada tugas.</td></tr>
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
        $('#tugasTable').DataTable({
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

        // Bootstrap Tooltip
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.forEach(function (tooltipTriggerEl) {
            new bootstrap.Tooltip(tooltipTriggerEl);
        });

    });
</script>
@endpush

@extends('layouts.admin')

@section('content')
<div class="container mb-5">
    <h4 class="fw-bold mb-4">Daftar Tugas Kuliah</h4>

    <div class="table-responsive rounded shadow-sm border p-3">
        <table class="table table-striped table-hover align-middle text-center" id="tugasTable">
            <thead class="table-primary text-uppercase">
                <tr>
                    <th style="width: 5%;">No</th>
                    <th class="text-start" style="width: 20%;">Judul</th>
                    <th class="text-start" style="width: 30%;">Deskripsi</th>
                    <th style="width: 20%;">Deadline</th>
                    <th style="width: 10%;">File</th>
                    <th style="width: 15%;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tugas as $i => $item)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td class="text-start">{{ $item->judul }}</td>
                        <td class="text-start text-truncate" style="max-width: 300px;">{{ $item->deskripsi }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->deadline)->translatedFormat('d F Y H:i') }}</td>
                        <td>
                            @if ($item->file_tugas)
                                <a href="{{ route('download.tugas', basename($item->file_tugas)) }}"
                                   class="btn btn-sm btn-outline-primary" title="Download File">
                                    <i class="bi bi-download"></i> Download
                                </a>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('mahasiswa.jawaban.create', $item->id) }}"
                               class="btn btn-sm btn-success px-3">
                                <i class="bi bi-upload me-1"></i> Kumpulkan
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-muted text-center">Belum ada tugas tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection


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
                infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                infoFiltered: "(disaring dari _MAX_ total data)",
                zeroRecords: "Data tidak ditemukan",
                paginate: {
                    first: "Awal",
                    last: "Akhir",
                    next: "›",
                    previous: "‹"
                }
            }
        });
    });
</script>
@endpush


@extends('layouts.admin')

@section('content')
<div class="container mb-5">
    {{-- Judul --}}
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center mb-4 gap-2">
        <h4 class="fw-bold mb-0">Jawaban Saya</h4>
    </div>

    {{-- Flash Message --}}
    @if(session('success'))
        <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
    @endif

    {{-- Tabel Jawaban --}}
    <div class="table-responsive rounded shadow-sm border p-3">
        <table id="jawabanTable" class="table table-striped table-hover align-middle w-100">
            <thead class="table-primary text-uppercase text-center">
                <tr>
                    <th>No</th>
                    <th class="text-start">Judul Tugas</th>
                    <th>Nilai</th>
                    <th>Komentar</th>
                    <th>File</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($jawaban as $i => $item)
                    <tr>
                        <td class="text-center">{{ $i + 1 }}</td>
                        <td class="text-start">{{ $item->tugas->judul }}</td>
                        <td class="text-center">{{ $item->nilai ?? '-' }}</td>
                        <td class="text-start">{{ $item->komentar ?? '-' }}</td>
                        <td class="text-center">
                            <a href="{{ route('download.jawaban', basename($item->file_jawaban)) }}" class="btn btn-sm btn-outline-primary" title="Download Jawaban">
                                <i class="bi bi-download"></i> Download
                            </a>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('mahasiswa.jawaban.edit', $item->id) }}" class="btn btn-sm btn-outline-warning" title="Revisi Jawaban">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-muted text-center">Belum ada jawaban yang dikumpulkan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('style')
<style>
    #jawabanTable th, #jawabanTable td {
        padding: 0.75rem 1rem;
    }
</style>
@endpush

@push('script')
<script>
    $(document).ready(function () {
        $('#jawabanTable').DataTable({
            responsive: true,
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data",
                info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
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

@extends('layouts.admin')

@section('content')
<div class="container mb-5">
    {{-- Judul --}}
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <h4 class="fw-bold mb-0">Daftar Mata Kuliah</h4>
    </div>

    {{-- Filter Semester --}}
    <form method="GET" class="mb-3">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-4">
                <select name="semester" class="form-select shadow-sm" onchange="this.form.submit()">
                    <option value="">-- Semua Semester --</option>
                    @foreach ($semesters as $s)
                        <option value="{{ $s }}" {{ request('semester') == $s ? 'selected' : '' }}>
                            {{ $s }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </form>

    {{-- Tabel --}}
    <div class="table-responsive rounded shadow-sm border p-3">
        <table id="tabelMatkul" class="table table-striped table-hover align-middle w-100 text-center">
            <thead class="table-primary text-uppercase">
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 15%;">Kode MK</th>
                    <th class="text-start" style="width: 30%;">Nama Mata Kuliah</th>
                    <th style="width: 25%;">Dosen</th>
                    <th style="width: 15%;">Semester</th>
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
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-muted text-center">Tidak ada mata kuliah ditemukan.</td>
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
        $('#tabelMatkul').DataTable({
            responsive: true,
            pageLength: 10,
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data",
                info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                zeroRecords: "Tidak ditemukan",
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

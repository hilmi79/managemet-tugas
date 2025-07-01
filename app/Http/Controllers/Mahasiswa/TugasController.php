<?php

namespace App\Http\Controllers\Mahasiswa;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tugas;
use Illuminate\Support\Facades\Auth;

class TugasController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $tugas = Tugas::whereDoesntHave('pengumpulanTugas', function ($query) use ($userId) {
            $query->where('mahasiswa_id', $userId);
        })->get();

        return view('mahasiswa.tugas.index', compact('tugas'));
    }
    public function show($id)
{
    $tugas = Tugas::with('matakuliah')->findOrFail($id);

    // Cek apakah mahasiswa sudah mengumpulkan
    $pengumpulan = \App\Models\PengumpulanTugas::where('tugas_id', $id)
        ->where('mahasiswa_id', Auth::id())
        ->first();

    return view('mahasiswa.tugas.show', compact('tugas', 'pengumpulan'));
}

}

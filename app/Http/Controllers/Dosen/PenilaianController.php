<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PengumpulanTugas;
use Illuminate\Support\Facades\Auth;

class PenilaianController extends Controller
{
    /**
     * Tampilkan semua jawaban mahasiswa untuk tugas-tugas dosen
     */
    public function index()
{
    $pengumpulan = PengumpulanTugas::with(['tugas', 'mahasiswa'])
        ->whereNull('nilai')
        ->whereHas('tugas', function ($query) {
            $query->where('created_by', Auth::id());
        })
        ->latest()
        ->get();

    return view('dosen.penilaian.index', compact('pengumpulan'));
}


    /**
     * Halaman form untuk menilai tugas mahasiswa
     */
    public function edit($id)
    {
        $jawaban = PengumpulanTugas::with(['tugas', 'mahasiswa'])
            ->whereHas('tugas', function ($query) {
                $query->where('created_by', Auth::id());
            })
            ->findOrFail($id);

        return view('dosen.penilaian.edit', compact('jawaban'));
    }

    /**
     * Simpan nilai dan komentar
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nilai' => 'required|numeric|min:0|max:100',
            'komentar' => 'nullable|string',
        ]);

        $jawaban = PengumpulanTugas::with('tugas')
            ->whereHas('tugas', function ($query) {
                $query->where('created_by', Auth::id());
            })
            ->findOrFail($id);

        $jawaban->update([
            'nilai' => $request->nilai,
            'komentar' => $request->komentar,
        ]);

        return redirect()->route('dosen.penilaian.index')
            ->with('success', 'Penilaian berhasil disimpan.');
    }

}

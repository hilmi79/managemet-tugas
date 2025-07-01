<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tugas;
use App\Models\PengumpulanTugas;


class JawabanController extends Controller
{
    public function index()
{
    $jawaban = PengumpulanTugas::with('tugas')
        ->where('mahasiswa_id', Auth::id())
        ->latest()
        ->get();

    return view('mahasiswa.jawaban.index', compact('jawaban'));
}

    public function create($tugas_id)
{
    $tugas = Tugas::findOrFail($tugas_id);
    $sudahMengumpulkan = PengumpulanTugas::where('tugas_id', $tugas_id)
        ->where('mahasiswa_id', Auth::id())
        ->exists();

    if ($sudahMengumpulkan) {
        return redirect()->back()->with('warning', 'Kamu sudah mengumpulkan tugas ini.');
    }

    return view('mahasiswa.jawaban.create', compact('tugas'));
}


public function store(Request $request)
    {
        $request->validate([
            'tugas_id' => 'required|exists:tugas,id',
            'file_jawaban' => 'required|file|mimes:pdf,docx,zip',
        ]);

        $file = $request->file('file_jawaban');
        $originalName = $file->getClientOriginalName();
        $filename = time() . '-' . $originalName;
        $path = $file->storeAs('jawaban', $filename, 'public');

        PengumpulanTugas::create([
            'tugas_id' => $request->tugas_id,
            'mahasiswa_id' => Auth::id(),
            'file_jawaban' => $path,
            'file_original' => $originalName,
        ]);

        return redirect()->route('mahasiswa.tugas.index')->with('success', 'Jawaban berhasil dikumpulkan!');
    }
    public function edit($id)
{
    $jawaban = PengumpulanTugas::where('mahasiswa_id', Auth::id())->findOrFail($id);
    return view('mahasiswa.jawaban.edit', compact('jawaban'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'file_jawaban' => 'required|file|mimes:pdf,docx,zip',
    ]);

    $jawaban = PengumpulanTugas::where('mahasiswa_id', Auth::id())->findOrFail($id);

    $file = $request->file('file_jawaban');
    $originalName = $file->getClientOriginalName();
    $filename = time() . '-' . $originalName;
    $path = $file->storeAs('jawaban', $filename, 'public');

    $jawaban->update([
        'file_jawaban' => $path,
        'file_original' => $originalName,
    ]);

    return redirect()->route('mahasiswa.jawaban.index')->with('success', 'Jawaban berhasil diperbarui.');
}
}

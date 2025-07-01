<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tugas;
use Illuminate\Support\Facades\Auth;
use App\Models\Matakuliah;
use Illuminate\Support\Facades\Storage;

class TugasController extends Controller
{
    public function index()
    {
        $tugas = Tugas::where('created_by', Auth::id())->latest()->get();
        return view('dosen.tugas.index', compact('tugas'));
    }

    public function create()
{
    $matakuliahList = Matakuliah::all();
    return view('dosen.tugas.create', compact('matakuliahList'));
}


public function store(Request $request)
{
    $request->validate([
        'judul' => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
        'file_tugas' => 'required|file|mimes:pdf,docx,zip',
        'deadline' => 'required|date',
        'matakuliah_id' => 'required|exists:matakuliah,id', // validasi tambahan
    ]);

    $file = $request->file('file_tugas');
    $originalName = $file->getClientOriginalName();
    $filename = time() . '-' . $originalName;
    $file->storeAs('tugas', $filename, 'public');

    Tugas::create([
        'judul' => $request->judul,
        'deskripsi' => $request->deskripsi,
        'file_tugas' => $filename,
        'file_original' => $originalName,
        'deadline' => $request->deadline,
        'matakuliah_id' => $request->matakuliah_id, // ini dia kuncinya
        'created_by' => Auth::id(),
    ]);

    return redirect()->route('dosen.tugas.index')->with('success', 'Tugas berhasil ditambahkan.');
}
public function edit($id)
{
    $tugas = Tugas::findOrFail($id);
    return view('dosen.tugas.edit', compact('tugas'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'judul' => 'required|string|max:255',
        'deskripsi' => 'required|string',
        'deadline' => 'required|date',
        'file_tugas' => 'nullable|file|mimes:pdf,docx,doc,xls,xlsx,zip|max:2048'
    ]);

    $tugas = Tugas::findOrFail($id);
    $tugas->judul = $request->judul;
    $tugas->deskripsi = $request->deskripsi;
    $tugas->deadline = $request->deadline;

    if ($request->hasFile('file_tugas')) {
        // Hapus file lama jika ada
        if ($tugas->file_tugas && Storage::exists($tugas->file_tugas)) {
            Storage::delete($tugas->file_tugas);
        }

        $filePath = $request->file('file_tugas')->store('tugas');
        $tugas->file_tugas = $filePath;
    }

    $tugas->save();

    return redirect()->route('dosen.tugas.index')->with('success', 'Tugas berhasil diperbarui.');
}

public function destroy($id)
{
    $tugas = Tugas::findOrFail($id);

    // Hapus file jika ada
    if ($tugas->file_tugas && Storage::exists($tugas->file_tugas)) {
        Storage::delete($tugas->file_tugas);
    }

    $tugas->delete();
    return redirect()->route('dosen.tugas.index')->with('success', 'Tugas berhasil dihapus.');
}


}

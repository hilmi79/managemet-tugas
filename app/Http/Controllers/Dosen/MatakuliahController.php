<?php

namespace App\Http\Controllers\Dosen;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Matakuliah;
class MatakuliahController extends Controller
{
    public function index(Request $request)
    {
        $semesterFilter = $request->get('semester');
        $query = Matakuliah::query();

        if ($semesterFilter) {
            $query->where('semester', $semesterFilter);
        }

        $matakuliah = $query->get();
        $semesters = Matakuliah::select('semester')->distinct()->pluck('semester');

        return view('dosen.matakuliah.index', compact('matakuliah', 'semesters', 'semesterFilter'));
    }

    public function create()
    {
        return view('dosen.matakuliah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'dosen' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'kode' => 'required|string|max:50',
            'semester' => 'required|string|in:Semester 1,Semester 2,Semester 3,Semester 4,Semester 5,Semester 6,Semester 7,Semester 8',
        ]);

        Matakuliah::create($request->only('dosen', 'nama', 'kode', 'semester'));

        return redirect()->route('dosen.matakuliah.index')->with('success', 'Mata kuliah berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $matakuliah = Matakuliah::findOrFail($id);
        return view('dosen.matakuliah.edit', compact('matakuliah'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'dosen' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'kode' => 'required|string|max:50',
            'semester' => 'required|string|in:Semester 1,Semester 2,Semester 3,Semester 4,Semester 5,Semester 6,Semester 7,Semester 8',
        ]);

        $matakuliah = Matakuliah::findOrFail($id);
        $matakuliah->update($request->only('dosen', 'nama', 'kode', 'semester'));

        return redirect()->route('dosen.matakuliah.index')->with('success', 'Mata kuliah berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $matakuliah = Matakuliah::findOrFail($id);
        $matakuliah->delete();

        return redirect()->route('dosen.matakuliah.index')->with('success', 'Mata kuliah berhasil dihapus.');
    }
}

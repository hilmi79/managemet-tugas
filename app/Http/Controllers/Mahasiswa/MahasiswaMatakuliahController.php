<?php
namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Matakuliah;
use Illuminate\Http\Request;

class MahasiswaMatakuliahController extends Controller
{
    public function index(Request $request)
{
    $semester = $request->get('semester');

    $semesters = Matakuliah::select('semester')->distinct()->pluck('semester');

    $matakuliah = $semester
        ? Matakuliah::where('semester', $semester)->get()
        : Matakuliah::all();

    return view('mahasiswa.matakuliah.index', compact('matakuliah', 'semesters'));
}



    public function show($id)
    {
        $matakuliah = Matakuliah::findOrFail($id);
        return view('mahasiswa.matakuliah.show', compact('matakuliah'));
    }
}

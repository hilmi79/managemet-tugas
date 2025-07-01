<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tugas;
use App\Models\PengumpulanTugas;
use App\Models\Matakuliah;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class DashboardController extends Controller
{
  public function index()
{
    $user = Auth::user();
    $data = [];

    if ($user->role === 'dosen') {
        $cards = [
            [
                'title' => 'Tugas Dibuat',
                'value' => Tugas::where('created_by', $user->id)->count(),
                'icon' => 'bi-journal-check',
                'color' => 'primary',
                'trend' => '+2 dari minggu lalu',
            ],
            [
                'title' => 'Jawaban Masuk',
                'value' => PengumpulanTugas::whereHas('tugas', fn($q) => $q->where('created_by', $user->id))->count(),
                'icon' => 'bi-inbox-fill',
                'color' => 'success',
                'trend' => '+15% dari minggu lalu',
            ],
            [
                'title' => 'Sudah Dinilai',
                'value' => PengumpulanTugas::whereHas('tugas', fn($q) => $q->where('created_by', $user->id))->whereNotNull('nilai')->count(),
                'icon' => 'bi-check-circle-fill',
                'color' => 'info',
                'trend' => '30 menunggu',
            ],
            [
                'title' => 'Mahasiswa Aktif',
                'value' => User::where('role', 'mahasiswa')->count(),
                'icon' => 'bi-people-fill',
                'color' => 'warning',
            ],
        ];

        $data['belumDinilai'] = PengumpulanTugas::whereNull('nilai')
            ->whereHas('tugas', fn($q) => $q->where('created_by', $user->id))
            ->with('user', 'tugas')
            ->latest()
            ->take(5)
            ->get();
        $data['tugasTerbaruDosen'] = Tugas::where('created_by', $user->id)
            ->latest('created_at')
            ->take(5)
            ->with('matakuliah')
            ->get();
        $data['terlambatKumpul'] = PengumpulanTugas::whereHas('tugas', fn($q) => $q->where('created_by', $user->id))
            ->whereNull('nilai')
            ->with(['user', 'tugas'])
            ->get()
            ->filter(fn($item) => $item->tugas && $item->created_at->gt($item->tugas->deadline));


    } elseif ($user->role === 'mahasiswa') {
        $totalTugas = Tugas::count();
        $tugasDikerjakan = PengumpulanTugas::where('mahasiswa_id', $user->id)->count();
        $progress = $totalTugas > 0 ? round(($tugasDikerjakan / $totalTugas) * 100) : 0;

        $cards = [
            [
                'title' => 'Belum Dikerjakan',
                'value' => $totalTugas - $tugasDikerjakan,
                'icon' => 'bi-bookmark-x-fill',
                'color' => 'danger',
            ],
            [
                'title' => 'Tugas Terkirim',
                'value' => $tugasDikerjakan,
                'icon' => 'bi-send-fill',
                'color' => 'success',
            ],
            [
                'title' => 'Nilai Rata-rata',
                'value' => number_format(PengumpulanTugas::where('mahasiswa_id', $user->id)->avg('nilai') ?? 0, 2),
                'icon' => 'bi-star-fill',
                'color' => 'warning',
                'trend' => '+0.5 dari semester lalu',
            ],
            [
                'title' => 'Deadline Dekat',
                'value' => Tugas::where('deadline', '>=', now())->count(),
                'icon' => 'bi-clock-fill',
                'color' => 'info',
                'trend' => 'Segera dikumpulkan',
            ],
        ];

        $data['tugasDikerjakan'] = $tugasDikerjakan;
        $data['totalTugas'] = $totalTugas;
        $data['progress'] = $progress;
        $data['nilaiTerbaru'] = PengumpulanTugas::where('mahasiswa_id', $user->id)
            ->whereNotNull('nilai')
            ->with('tugas')
            ->latest('updated_at')
            ->take(5)
            ->get();

        $data['tugasTerbaru'] = Tugas::latest('created_at')
            ->where('deadline', '>=', now())
            ->take(5)
            ->get();
        $data['tugasDeadlineDekat'] = Tugas::where('deadline', '>=', now())
            ->whereNotIn('id', PengumpulanTugas::where('mahasiswa_id', $user->id)->pluck('tugas_id'))
            ->orderBy('deadline')
            ->take(3)
            ->get();
    }

    return view('dashboard', compact('cards', 'data'));
}
    public function show($id)
    {
        $tugas = Tugas::with('matakuliah')->findOrFail($id);

        // Cek apakah mahasiswa sudah mengumpulkan
        $pengumpulan = PengumpulanTugas::where('tugas_id', $id)
            ->where('mahasiswa_id', Auth::id())
            ->first();

        return view('mahasiswa.tugas.show', compact('tugas', 'pengumpulan'));
    }

}


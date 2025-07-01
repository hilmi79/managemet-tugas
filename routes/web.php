<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Dosen\TugasController as DosenTugasController;
use App\Http\Controllers\Dosen\PenilaianController;
use App\Http\Controllers\Mahasiswa\TugasController as MahasiswaTugasController;
use App\Http\Controllers\Mahasiswa\JawabanController;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\Dosen\MatakuliahController;
use App\Http\Controllers\Mahasiswa\MahasiswaMatakuliahController;
use App\Http\Controllers\Mahasiswa\TugasController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman utama (opsional bisa diganti dashboard juga)
// Halaman utama
Route::get('/', fn() => view('welcome'));

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Group: Semua user yang login
Route::middleware(['auth'])->group(function () {
    // Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Download
    Route::get('/download/tugas/{filename}', [DownloadController::class, 'tugas'])->name('download.tugas');
    Route::get('/download/jawaban/{filename}', [DownloadController::class, 'jawaban'])->name('download.jawaban');
});

// Dosen
Route::middleware(['auth', 'role:dosen'])->prefix('dosen')->name('dosen.')->group(function () {
    Route::resource('/tugas', DosenTugasController::class);
    Route::resource('/penilaian', PenilaianController::class);
    Route::post('/notes', [NoteController::class, 'store'])->name('notes.store');

    Route::get('/matakuliah/create', [MatakuliahController::class, 'create'])->name('matakuliah.create');
    Route::post('/matakuliah', [MatakuliahController::class, 'store'])->name('matakuliah.store');
    Route::get('/matakuliah', [MatakuliahController::class, 'index'])->name('matakuliah.index');
    Route::get('/matakuliah/{id}/edit', [MatakuliahController::class, 'edit'])->name('matakuliah.edit');
    Route::put('/matakuliah/{id}', [MatakuliahController::class, 'update'])->name('matakuliah.update');
    Route::delete('/matakuliah/{id}', [MatakuliahController::class, 'destroy'])->name('matakuliah.destroy');
});


// Group: Role Mahasiswa
Route::middleware(['auth', 'role:mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    Route::get('/jawaban/create/{tugas_id}', [JawabanController::class, 'create'])->name('jawaban.create'); // <- MANUAL

    Route::resource('/jawaban', JawabanController::class)->only([
        'index', 'store', 'edit', 'update'
    ]);

    Route::resource('/tugas', MahasiswaTugasController::class);
    Route::get('/matakuliah', [MahasiswaMatakuliahController::class, 'index'])->name('matakuliah.index');
    Route::get('tugas/{id}', [TugasController::class, 'show'])->name('tugas.show'); // <- jangan dobel prefix
});




// Autentikasi
require __DIR__.'/auth.php';

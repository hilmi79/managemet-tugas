<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Tugas;

class PengumpulanTugas extends Model
{
    use HasFactory;

    protected $fillable = [
        'tugas_id',
        'mahasiswa_id',
        'file_jawaban',
        'submitted_at',
        'nilai',
        'komentar'
    ];

    protected $dates = ['submitted_at'];

    // Relasi ke tugas
    public function tugas()
    {
        return $this->belongsTo(Tugas::class);
    }

    // Relasi ke mahasiswa
    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'mahasiswa_id');
    }
    public function user()
{
    return $this->belongsTo(User::class, 'mahasiswa_id');
}
}

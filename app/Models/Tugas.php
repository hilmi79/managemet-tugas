<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'deskripsi',
        'file_tugas',
        'created_by',
        'deadline',
        'matakuliah_id',
    ];

    public function pembuat()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function matakuliah()
    {
        return $this->belongsTo(Matakuliah::class);
    }

    public function pengumpulan()
{
    return $this->hasMany(\App\Models\PengumpulanTugas::class);
}
public function pengumpulanTugas()
{
    return $this->hasMany(\App\Models\PengumpulanTugas::class, 'tugas_id');
}

}

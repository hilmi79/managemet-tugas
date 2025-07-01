<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Tugas;

class Matakuliah extends Model
{
    protected $table = 'matakuliah';

    protected $fillable = ['kode', 'nama', 'semester', 'user_id', 'dosen'];

    // 1 matakuliah punya banyak tugas
    public function tugas()
    {
        return $this->hasMany(Tugas::class);
    }

    // banyak mahasiswa ambil satu matkul (pivot: matakuliah_mahasiswa)
    public function mahasiswa()
    {
        return $this->belongsToMany(User::class, 'matakuliah_mahasiswa', 'matakuliah_id', 'user_id');
    }

    // jika dosen disimpan sebagai user_id
    public function dosen()
    {
        return $this->belongsTo(User::class, 'user_id')->where('role', 'dosen');
    }
}

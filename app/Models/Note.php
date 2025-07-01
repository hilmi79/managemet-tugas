<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = ['dosen_id', 'content'];

    public function dosen()
    {
        return $this->belongsTo(User::class, 'dosen_id');
    }
}

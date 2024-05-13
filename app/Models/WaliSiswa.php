<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaliSiswa extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function JenisKelaminWali()
    {
        return $this->belongsTo(JenisKelamin::class, 'jenis_kelamin_id', 'id');
    }

    public function Siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id', 'id');
    }
}

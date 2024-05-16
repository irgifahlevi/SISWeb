<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaliCalonSiswa extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function Users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function JenisKelamin()
    {
        return $this->belongsTo(JenisKelamin::class, 'jenis_kelamin_id', 'id');
    }

    public function CalonSiswaWali()
    {
        return $this->hasMany(CalonSiswa::class, 'wali_calon_siswa_id', 'id');
    }

    public function PendaftaranCalonWali()
    {
        return $this->hasMany(Pendaftaran::class, 'wali_calon_siswa_id', 'id');
    }
}

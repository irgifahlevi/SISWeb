<?php

namespace App\Models;

use App\Models\Pendaftaran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CalonSiswa extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function WaliCalonSiswa()
    {
        return $this->belongsTo(WaliCalonSiswa::class, 'wali_calon_siswa_id', 'id');
    }

    public function PendaftaranCalonSiswa()
    {
        return $this->hasOne(Pendaftaran::class, 'calon_siswa_id', 'id');
    }

    public function JenisKelaminCalonSiswa()
    {
        return $this->belongsTo(JenisKelamin::class, 'jenis_kelamin_id', 'id');
    }
}

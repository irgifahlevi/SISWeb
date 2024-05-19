<?php

namespace App\Models;

use App\Models\CalonSiswa;
use App\Models\WaliCalonSiswa;
use App\Models\InfoPendaftaran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pendaftaran extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function CalonWaliPendaftaran()
    {
        return $this->belongsTo(WaliCalonSiswa::class, 'wali_calon_siswa_id', 'id');
    }

    public function CalonSiswaPendaftaran()
    {
        return $this->belongsTo(CalonSiswa::class, 'calon_siswa_id', 'id');
    }

    public function InfoBiayaPendaftaran()
    {
        return $this->belongsTo(InfoPendaftaran::class, 'info_pendaftaran_id', 'id');
    }
}

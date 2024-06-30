<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestToken extends Model
{
    use HasFactory;

    public function RequestTokenTagihan()
    {
        return $this->belongsTo(TagihanSiswa::class, 'tagihan_siswa_id', 'id');
    }

    public function RequestTokenPendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'pendaftaran_id', 'id');
    }
}

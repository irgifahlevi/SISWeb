<?php

namespace App\Models;

use App\Models\InfoPendaftaran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BiayaPendaftaran extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function InfoPendaftarans()
    {
        return $this->belongsTo(InfoPendaftaran::class, 'info_pendaftaran_id', 'id');
    }
}

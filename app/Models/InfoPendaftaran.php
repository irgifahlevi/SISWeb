<?php

namespace App\Models;

use App\Models\BiayaPendaftaran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InfoPendaftaran extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function BiayaPendaftaran()
    {
        return $this->hasMany(BiayaPendaftaran::class, 'info_pendaftaran_id', 'id');
    }
}

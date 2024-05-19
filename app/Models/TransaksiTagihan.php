<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiTagihan extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function TransaksiTagihanSiswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id', 'id');
    }

    public function TransaksiTagihan()
    {
        return $this->belongsTo(TagihanSiswa::class, 'tagihan_siswa_id', 'id');
    }
}

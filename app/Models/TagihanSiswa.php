<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagihanSiswa extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function TagihanSiswas()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id', 'id');
    }

    public function TagihanKelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }

    public function TagihanTransaksi()
    {
        return $this->hasOne(TransaksiTagihan::class, 'tagihan_siswa_id', 'id');
    }

    public function TokenTagihan()
    {
        return $this->hasMany(RequestToken::class, 'tagihan_siswa_id', 'id');
    }
}

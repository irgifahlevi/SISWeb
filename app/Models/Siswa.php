<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function KelasSiswa()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }
    public function JenisKelaminSiswa()
    {
        return $this->belongsTo(JenisKelamin::class, 'jenis_kelamin_id', 'id');
    }

    public function UserSiswa()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function SiswaWali()
    {
        return $this->hasMany(WaliSiswa::class, 'siswa_id', 'id');
    }

    public function SiswaTagihan()
    {
        return $this->hasMany(TagihanSiswa::class, 'siswa_id', 'id');
    }

    public function SiswaTransaksiTagihan()
    {
        return $this->hasMany(TransaksiTagihan::class, 'siswa_id', 'id');
    }
}

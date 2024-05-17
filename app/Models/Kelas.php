<?php

namespace App\Models;

use App\Models\Siswa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kelas extends Model
{
    protected $guarded = [];
    use HasFactory;


    public function Siswa()
    {
        return $this->hasOne(Siswa::class, 'kelas_id', 'id');
    }

    public function KelasTagihan()
    {
        return $this->hasMany(TagihanSiswa::class, 'kelas_id', 'id');
    }
}

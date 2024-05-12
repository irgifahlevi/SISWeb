<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKelamin extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function WaliCalon()
    {
        return $this->hasOne(WaliCalonSiswa::class, 'jenis_kelamin_id', 'id');
    }

    public function SiswaJenisKelamin()
    {
        return $this->hasOne(Siswa::class, 'jenis_kelamin_id', 'id');
    }
}

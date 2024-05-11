<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function Kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }
}

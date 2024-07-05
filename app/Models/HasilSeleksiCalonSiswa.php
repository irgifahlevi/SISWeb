<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilSeleksiCalonSiswa extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function InfoHasilSeleksiCalon()
    {
        return $this->belongsTo(Pendaftaran::class, 'pendaftaran_id', 'id');
    }
}

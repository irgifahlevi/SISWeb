<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DokumenPendaftar extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function Pendaftar()
    {
        return $this->hasMany(Pendaftaran::class, 'pendaftaran_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilePendidik extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function JenisKelaminPendidik()
    {
        return $this->belongsTo(JenisKelamin::class, 'jenis_kelamin_id', 'id');
    }
    public function ProfilePendidik()
    {
        return $this->belongsTo(TenagaPendidik::class, 'tenaga_pendidik_id', 'id');
    }
}

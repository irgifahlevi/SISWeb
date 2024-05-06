<?php

namespace App\Models;

use App\Models\JenisKelamin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WaliCalonSiswa extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function Users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function JenisKelamin()
    {
        return $this->belongsTo(JenisKelamin::class, 'jenis_kelamin_id', 'id');
    }
}

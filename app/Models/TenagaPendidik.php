<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenagaPendidik extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function TenagaProfilePendidik()
    {
        return $this->hasOne(ProfilePendidik::class, 'tenaga_pendidik_id', 'id');
    }
}

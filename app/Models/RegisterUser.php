<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class RegisterUser extends Authenticatable
{
    protected $fillable = [
        'username',
        'email',
        'status',
        'created_by',
        'created_at',
        'login',
        'login_date',
        'row_status'
    ];
    use HasFactory;
}

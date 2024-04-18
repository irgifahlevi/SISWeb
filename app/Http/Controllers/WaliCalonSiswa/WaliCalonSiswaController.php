<?php

namespace App\Http\Controllers\WaliCalonSiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WaliCalonSiswaController extends Controller
{
    public function index()
    {
        return view('WaliCalonView.index');
    }
}

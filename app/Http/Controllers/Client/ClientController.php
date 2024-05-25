<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Models\PengantarKepsek;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{

    public function index()
    {
        $pengantar_kepsek = PengantarKepsek::where('row_status', 0)
            ->orderBy('id', 'desc')
            ->first();
        return view('ClientView.index', compact('pengantar_kepsek'));
    }
}

<?php

namespace App\Http\Controllers\Siswa;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\TagihanSiswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    public function index()
    {
        // Mendapatkan ID pengguna yang sedang login
        $user_id = Auth::id();

        $tagihan = [];

        // Mendapatkan data siswa berdasarkan user_id
        $siswa = Siswa::where('user_id', $user_id)->with('KelasSiswa', 'SiswaTagihan')->first();

        if ($siswa) {
            // Mendapatkan tagihan siswa yang belum dibayar
            $tagihan = $siswa->SiswaTagihan()->where('status', 'belum_dibayar')->where('row_status', 0)->get();
        }

        return view('SiswaView.index', compact('tagihan'));
    }
}

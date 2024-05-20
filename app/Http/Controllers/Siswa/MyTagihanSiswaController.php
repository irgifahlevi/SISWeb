<?php

namespace App\Http\Controllers\Siswa;

use App\Models\Siswa;
use App\Models\TagihanSiswa;
use Illuminate\Http\Request;
use App\Models\TransaksiTagihan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MyTagihanSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search_tagihan = $request->query('search_tagihan');
        // Mendapatkan ID pengguna yang sedang login
        $user_id = Auth::id();
        // Mendapatkan data siswa berdasarkan user_id
        $siswa = Siswa::where('user_id', $user_id)->with('KelasSiswa', 'SiswaTagihan')->first();

        // Mendapatkan tagihan siswa yang belum dibayar
        $tagihanQuery = $siswa->SiswaTagihan()->where('row_status', 0)->orderBy('id', 'desc');

        // Jika ada pencarian, tambahkan kondisi pencarian
        if ($search_tagihan) {
            $tagihanQuery->where(function ($query) use ($search_tagihan) {
                $query->where('nama_tagihan', 'like', '%' . $search_tagihan . '%');
            });
        }

        // Paginasi hasil
        $data = $tagihanQuery->paginate(10)->onEachSide(2)->fragment('tagihan');

        return view('SiswaView.MyTagihanSiswa.index', compact('data', 'search_tagihan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $kode)
    {
        $user_id = Auth::id();

        // Mendapatkan data siswa berdasarkan user_id
        $siswa = Siswa::select('id')->where('user_id', $user_id)->first();
        $data = TransaksiTagihan::with(
            'TransaksiTagihanSiswa',
            'TransaksiTagihan'
        )->where('row_status', 0)->whereHas('TransaksiTagihan', function ($query) use ($kode, $siswa) {
            $query->where('kode_tagihan', $kode);
            $query->where('siswa_id', $siswa->id);
            $query->where('status', 'dibayar');
            $query->where('row_status', 0);
        })->first();

        return view('SiswaView.MyTagihanSiswa.invoice_tagihan', compact('data', 'kode'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

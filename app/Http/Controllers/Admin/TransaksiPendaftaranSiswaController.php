<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransaksiPendaftaranSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search_transaksi = $request->query('search_transaksi');

        $query = Pendaftaran::with('CalonWaliPendaftaran.Users', 'CalonSiswaPendaftaran.JenisKelaminCalonSiswa', 'InfoBiayaPendaftaran.BiayaPendaftaran')
            ->where('row_status', 0)
            ->where('status_seleksi', '=', 'lolos')
            ->where('is_document', '=', 1)
            ->orderBy('id', 'desc');

        if (!empty($search_transaksi)) {
            $query->where('kode_pendaftaran', 'like', '%' . $search_transaksi . '%');
        }

        $data = $query->paginate(10)->onEachSide(2)->fragment('transaksi');

        return view('AdminView.DataTransaksiPendaftaran.index', compact('data', 'search_transaksi'));
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
    public function show(string $id)
    {
        //
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

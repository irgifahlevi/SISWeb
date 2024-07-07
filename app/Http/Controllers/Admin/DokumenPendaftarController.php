<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DokumenPendaftaranCalonSiswa;
use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Helpers\GeneralHelpers;
use App\Helpers\ResponseHelpers;
use Exception;

class DokumenPendaftarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search_dokumen = $request->query('search_dokumen');

        $query = Pendaftaran::with('CalonWaliPendaftaran.Users', 'CalonSiswaPendaftaran.JenisKelaminCalonSiswa', 'InfoBiayaPendaftaran.BiayaPendaftaran', 'DokumenCalonSiswa')
            ->where('row_status', 0)
            ->where('status_seleksi', 'belum_dinilai')
            ->orderBy('id', 'desc');

        if (!empty($search_dokumen)) {
            $query->where('kode_pendaftaran', 'like', '%' . $search_dokumen . '%');
        }

        $data = $query->paginate(10)->onEachSide(2)->fragment('transaksi');
        return view('AdminView.DokumenPendaftaranSiswa.index', compact('data', 'search_dokumen'));
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
        try
        {
            $data = Pendaftaran::with('CalonWaliPendaftaran.Users', 'CalonSiswaPendaftaran.JenisKelaminCalonSiswa', 'InfoBiayaPendaftaran.BiayaPendaftaran', 'DokumenCalonSiswa')
        ->where('kode_pendaftaran', $kode)
        ->where('row_status', 0)->first();
        // dd($data);
        return view('AdminView.DokumenPendaftaranSiswa.detail_dokumen_pendaftar', compact('data'));
        } catch (Exception $th) {
            return ResponseHelpers::ErrorResponse('Internal server error, try again later', 500);
        }

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

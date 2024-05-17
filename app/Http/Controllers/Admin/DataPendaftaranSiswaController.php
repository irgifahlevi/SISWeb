<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CalonSiswa;

class DataPendaftaranSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search_data = $request->query('search_data');

        $query = CalonSiswa::with('WaliCalonSiswa.Users', 'PendaftaranCalonSiswa', 'JenisKelaminCalonSiswa')
            ->where('row_status', 0)
            ->whereHas('PendaftaranCalonSiswa', function ($query) {
                $query->where('status', 'Success');
                $query->where('is_bayar', 1);
            })->orderBy('id', 'desc');

        if (!empty($search_data)) {
            $query->where('nama_lengkap', 'like', '%' . $search_data . '%');
        }

        $data = $query->paginate(10)->onEachSide(2)->fragment('transaksi');

        return view('AdminView.DataPendaftaranSiswa.index', compact('data', 'search_data'));
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
        $data = CalonSiswa::with('WaliCalonSiswa.Users', 'PendaftaranCalonSiswa', 'JenisKelaminCalonSiswa')
            ->where('id', $id)
            ->where('row_status', 0)
            ->whereHas('PendaftaranCalonSiswa', function ($query) {
                $query->where('status', 'Success');
                $query->where('is_bayar', 1);
            })->first();
        return view('AdminView.DataPendaftaranSiswa.profile_pendaftar', compact('data'));
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

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TransaksiTagihan;
use Illuminate\Http\Request;

class TransaksiTagihanSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search_transaksi = $request->query('search_transaksi');
        $query = TransaksiTagihan::with(['TransaksiTagihan.TagihanKelas' => function ($query) {
            $query->where('row_status', 0);
        }])
            ->where('row_status', 0)
            ->whereHas('TransaksiTagihan.TagihanKelas', function ($query) use ($search_transaksi) {
                if (!empty($search_transaksi)) {
                    $query->where('kelas', 'like', '%' . $search_transaksi . '%');
                }
            })
            ->orderBy('id', 'desc');

        $data = $query->paginate(10)->onEachSide(2)->fragment('tagihan');
        return view('AdminView.DataTransaksiTagihan.index', compact('data', 'search_transaksi'));
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

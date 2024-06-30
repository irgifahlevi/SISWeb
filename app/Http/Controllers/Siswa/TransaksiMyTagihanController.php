<?php

namespace App\Http\Controllers\Siswa;

use PDF;
use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Models\TransaksiTagihan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TransaksiMyTagihanController extends Controller
{
    public function index(Request $request)
    {
        $search_transaksi = $request->query('search_transaksi');

        $user_id = Auth::id();
        // Mendapatkan data siswa berdasarkan user_id
        $siswa = Siswa::where('user_id', $user_id)->with('KelasSiswa', 'SiswaTagihan')->first();

        // Periksa apakah data siswa ditemukan
        if (!$siswa) {
            return redirect()->back()->with('error', 'Data siswa tidak ditemukan.');
        }

        // Query untuk mendapatkan transaksi tagihan
        $query = TransaksiTagihan::with('TransaksiTagihan.TagihanKelas', 'TransaksiTagihanSiswa')->where('row_status', 0)
            ->where('siswa_id', $siswa->id)
            ->when($search_transaksi, function ($query) use ($search_transaksi) {
                $query->whereHas('TagihanSiswa', function ($query) use ($search_transaksi) {
                    $query->where('nama_tagihan', 'like', '%' . $search_transaksi . '%');
                });
            })
            ->orderBy('id', 'desc');

        $data = $query->paginate(10)->onEachSide(2)->fragment('tagihan');

        return view('SiswaView.MyTransaksiSiswa.index', compact('data', 'search_transaksi'));
    }

    public function showDocument(Request $request)
    {
        $semester = $request->semester;
        $user_id = Auth::id();
        // Mendapatkan data siswa berdasarkan user_id
        $siswa = Siswa::where('user_id', $user_id)->with('KelasSiswa', 'SiswaTagihan')->first();

        // Periksa apakah data siswa ditemukan
        if (!$siswa) {
            return redirect()->back()->with('error', 'Data siswa tidak ditemukan.');
        }

        // Query untuk mendapatkan transaksi tagihan
        $tagihan = TransaksiTagihan::with('TransaksiTagihan.TagihanKelas', 'TransaksiTagihanSiswa')->where('row_status', 0)
            ->where('siswa_id', $siswa->id)
            ->when($semester, function ($query) use ($semester) {
                $query->whereHas('TransaksiTagihan', function ($query) use ($semester) {
                    $query->where('semester', '=', $semester);
                });
            })
            ->orderBy('id', 'desc')
            ->get();

        $data_pdf = PDF::loadView('SiswaView.MyTransaksiSiswa.view_page_pdf', array('transaksi' => $tagihan, 'siswa' => $siswa, 'semester' => $semester))
            ->setPaper('a4', 'landscape');

        return $data_pdf->stream();
    }
}

<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Ekstrakurikuler;
use App\Models\Fasilitas;
use App\Models\Galleri;
use App\Models\KurikulumPrestasi;
use App\Models\PengantarKepsek;
use App\Models\ProfilePendidik;
use App\Models\Sejarah;
use App\Models\SliderKonten;
use App\Models\TenagaPendidik;
use App\Models\VisiMisi;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    public function index()
    {
        $pengantar_kepsek = PengantarKepsek::where('row_status', 0)
            ->orderBy('id', 'desc')
            ->first();

        $slider = SliderKonten::where('row_status', 0)->orderBy('id', 'desc')->paginate(4)->all();

        $profile_pendidik = ProfilePendidik::with(
            'JenisKelaminPendidik',
            'ProfilePendidik'
        )->whereHas('ProfilePendidik', function ($query) {
            $query->where('row_status', 0);
        })->where('row_status', '0')->orderBy('id', 'desc')->paginate(5);

        $fasilitas = Fasilitas::where('row_status', 0)->orderBy('id', 'desc')->paginate(8)->all();

        $berita = Berita::where('row_status', 0)->orderBy('id', 'desc')->paginate(8)->all();

        $ekstrakulikuler = Ekstrakurikuler::where('row_status', 0)->orderBy('id', 'desc')->paginate(5)->all();

        // $galeri = Galleri::where('row_status', 0)->orderBy('id', 'desc')->paginate(3)->all();
        $galeri = Galleri::where('row_status', 0)->orderBy('id', 'desc')->paginate(8)->all();

        $visi_misi = VisiMisi::where('row_status', 0)->orderBy('id', 'desc')->first();
        $misi_items = $visi_misi != null ? explode('•', $visi_misi->misi) : [];

        $sejarah = Sejarah::where('row_status', 0)->orderBy('id', 'desc')->first();

        // berita populer
        $berita_populer = Berita::where('row_status', 0)
            ->orderBy('id', 'asc')
            ->paginate(5)->all();

        // kurikulum
        $kurikulum_sekolah = KurikulumPrestasi::where('jenis_info', 'kurikulum')
            ->where('row_status', 0)->orderBy('id', 'desc')->first();
        $kurikulum_items = $kurikulum_sekolah != null ? explode('.', $kurikulum_sekolah->deskripsi) : [];

        $kegiatan = Galleri::where('row_status', 0)
            ->orderBy('id', 'asc')
            ->paginate(5)->all();

        $prestasi_sekolah = KurikulumPrestasi::where('jenis_info', 'prestasi')
            ->where('row_status', 0)->orderBy('id', 'desc')->paginate(8);

        return view('ClientView.index', compact(
            'pengantar_kepsek',
            'slider',
            'visi_misi',
            'misi_items',
            'profile_pendidik',
            'fasilitas',
            'ekstrakulikuler',
            'berita',
            'sejarah',
            'galeri',
            'berita_populer',
            'kurikulum_sekolah',
            'kurikulum_items',
            'kegiatan',
            'prestasi_sekolah'
        ));
    }
}

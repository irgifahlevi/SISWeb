<?php

namespace App\Http\Controllers\Admin;

use App\Models\JenisKelamin;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelpers;
use App\Http\Controllers\Controller;

class JenisKelaminController extends Controller
{
    public function getKelamin()
    {
        $data = JenisKelamin::select('id', 'jenis_kelamin') // Mengubah 'kelas' menjadi 'jenis_kelamin'
            ->where('row_status', '0')
            ->whereIn('jenis_kelamin', ['Laki-laki', 'Perempuan'])
            ->orderBy('id', 'desc')
            ->get();
        return ResponseHelpers::SuccessResponse('', $data, 200);
    }
}

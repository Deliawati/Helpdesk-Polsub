<?php

namespace App\Http\Controllers\Pengguna;

use App\Http\Controllers\Controller;
use App\Models\LayananAkademik;
use Illuminate\Http\Request;

class LayananAkademikController extends Controller
{
    //
    public function index()
    {
        $data['layanans'] = LayananAkademik::all();
        return view('pengguna.info-akademik.layanan.index', $data);
    }
}

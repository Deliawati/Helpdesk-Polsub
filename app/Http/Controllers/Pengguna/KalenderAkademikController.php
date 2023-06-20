<?php

namespace App\Http\Controllers\Pengguna;

use App\Http\Controllers\Controller;
use App\Models\KalenderAkademik;
use Illuminate\Http\Request;

class KalenderAkademikController extends Controller
{
    //
    public function index()
    {
        // get kalender dengan tahun_ajaran is 3 tahun terakhir
        $data['kalenders'] = KalenderAkademik::orderBy('tahun_ajaran', 'desc')->take(3)->get();

        return view('pengguna.info-akademik.kalender.index', $data);
    }
}

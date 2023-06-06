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
        // get all data from KalenderAkademik model where tahun_ajaran is now
        // or if not exists, get the latest data
        $data['kalender'] = KalenderAkademik::where('tahun_ajaran', date('Y'))->first() ?? KalenderAkademik::latest()->first();
        return view('pengguna.info-akademik.kalender.index', $data);
    }
}

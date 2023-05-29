<?php

namespace App\Http\Controllers\Pengguna;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KalenderAkademikController extends Controller
{
    //
    public function index()
    {
        return view('pengguna.info-akademik.kalender.index');
    }
}

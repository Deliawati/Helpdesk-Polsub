<?php

namespace App\Http\Controllers\Pengguna;

use App\Http\Controllers\Controller;
use App\Models\PeraturanAkademik;
use Illuminate\Http\Request;

class PeraturanAkademikController extends Controller
{
    //
    public function index()
    {
        $data['peraturans'] = PeraturanAkademik::all();

        return view('pengguna.info-akademik.peraturan.index', $data);
    }
}

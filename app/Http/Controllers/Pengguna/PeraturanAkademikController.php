<?php

namespace App\Http\Controllers\Pengguna;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PeraturanAkademikController extends Controller
{
    //
    public function index()
    {
        return view('pengguna.info-akademik.peraturan.index');
    }
}

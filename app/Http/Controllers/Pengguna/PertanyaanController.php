<?php

namespace App\Http\Controllers\Pengguna;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PertanyaanController extends Controller
{
    //
    public function index()
    {
        return view('pengguna.pertanyaan.index');
    }
}

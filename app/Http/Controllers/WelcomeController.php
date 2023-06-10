<?php

namespace App\Http\Controllers;

use App\Models\Tiket;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    //
    public function index()
    {
        $data['tiket_dibalas'] = Tiket::whereNotNull('balasan')->count();
        $data['tiket_belum_dibalas'] = Tiket::whereNull('balasan')->count();

        return view('welcome', $data);
    }
}

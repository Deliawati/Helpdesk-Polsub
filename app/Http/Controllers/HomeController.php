<?php

namespace App\Http\Controllers;

use App\Models\Tiket;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->role == 'superadmin') {
            $data['tiket_dibalas'] = Tiket::whereNotNull('balasan')->count();
            $data['tiket_belum_dibalas'] = Tiket::whereNull('balasan')->count();
        } else {
            $kategori = auth()->user()->permissions;
            foreach ($kategori as $k) {
                $kategori_id[] = $k->kategori->id;
            }
            $data['tiket_dibalas'] = Tiket::whereIn('kategori_id', $kategori_id)->whereNotNull('balasan')->count();
            $data['tiket_belum_dibalas'] = Tiket::whereIn('kategori_id', $kategori_id)->whereNull('balasan')->count();
        }
        return view('home', $data);
    }
}

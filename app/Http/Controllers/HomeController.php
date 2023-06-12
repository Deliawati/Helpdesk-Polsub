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
        switch (auth()->user()->role) {
            case 'admin1':
                // get data tiket dengan kategori 'UKT', 'beasiswa', 'kelulusan'
                $data['tiket_dibalas'] = Tiket::whereNotNull('balasan')->whereIn('kategori', ['UKT', 'beasiswa', 'kelulusan'])
                    ->count();
                $data['tiket_belum_dibalas'] = Tiket::whereNull('balasan')->whereIn('kategori', ['UKT', 'beasiswa', 'kelulusan'])
                    ->count();            
                break;
            case 'admin2':
                // get data tiket dengan kategori 'PMB', 'perkuliahan'
                $data['tiket_dibalas'] = Tiket::whereNotNull('balasan')->whereIn('kategori', ['PMB', 'perkuliahan'])
                    ->count();
                $data['tiket_belum_dibalas'] = Tiket::whereNull('balasan')->whereIn('kategori', ['PMB', 'perkuliahan'])
                    ->count();            
                break;
            case 'admin3':
                // get data tiket dengan kategori 'surat menyurat'
                $data['tiket_dibalas'] = Tiket::whereNotNull('balasan')->where('kategori', 'surat menyurat')
                    ->count();
                $data['tiket_belum_dibalas'] = Tiket::whereNull('balasan')->where('kategori', 'surat menyurat')
                    ->count();            
                break;            
            default:
                $data['tiket_dibalas'] = Tiket::whereNotNull('balasan')->count();
                $data['tiket_belum_dibalas'] = Tiket::whereNull('balasan')->count();
                break;
        }
        return view('home', $data);
    }
}

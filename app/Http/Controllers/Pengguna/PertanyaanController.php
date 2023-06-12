<?php

namespace App\Http\Controllers\Pengguna;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Tiket;
use Illuminate\Http\Request;

class PertanyaanController extends Controller
{
    //
    public function index()
    {
        $data['faqs'] = Faq::all();
        // if authentificated user
        if (auth()->user()) {
            $data['my_tickets'] = Tiket::where('user_id', auth()->user()->id)->get();
        }
        $data['kategoris'] = ['UKT', 'beasiswa', 'kelulusan', 'PMB', 'perkuliahan', 'surat menyurat'];

        return view('pengguna.pertanyaan.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required',
            'pertanyaan' => 'required'
        ]);

        $tiket = Tiket::create([
            'user_id' => auth()->user()->id,
            'kategori' => $request->kategori,
            'pertanyaan' => $request->pertanyaan
        ]);

        return redirect()->route('pertanyaan')->with('success', 'Tiket dengan id:'.$tiket->id.' pertanyaan berhasil dikirim');
    }

    public function faq()
    {
        $data['faqs'] = Faq::all();
        return view('pengguna.pertanyaan.faq', $data);
    }
}

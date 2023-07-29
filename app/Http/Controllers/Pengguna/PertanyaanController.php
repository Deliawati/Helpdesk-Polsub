<?php

namespace App\Http\Controllers\Pengguna;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\KategoriLayanan;
use App\Models\Tiket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
        $data['kategoris'] = KategoriLayanan::all();

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
            'kategori_id' => $request->kategori,
            'pertanyaan' => $request->pertanyaan
        ]);

        // send email to user
        Mail::to(auth()->user()->email)->send(new \App\Mail\TiketTerkirim($tiket));

        return redirect()->route('pertanyaan')->with('success', 'Tiket dengan id:'.$tiket->id.' pertanyaan berhasil dikirim');
    }

    public function faq()
    {
        $data['faqs'] = Faq::all();
        return view('pengguna.pertanyaan.faq', $data);
    }
}

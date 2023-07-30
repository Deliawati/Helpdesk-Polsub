<?php

namespace App\Http\Controllers\Pengguna;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\KategoriLayanan;
use App\Models\Tiket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
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

        // get all admin where kategori_id = $tiket->kategori_id
        $admins = User::whereHas('permissions', function ($q) use ($tiket) {
            $q->where('kategori_id', $tiket->kategori_id);
        })->get();

        // send notification to admin
        foreach ($admins as $admin) {
            // get no telp
            $no_telp = $admin->no_telp;
            // set message
            $message = "Harap segera dibalas pertanyaan baru dengan kategori ".$tiket->kategori->nama.". 
                Silahkan login ke dashboard untuk membalas pertanyaan.";
            // via wa
            try {
                $respose = Http::get(env('APP_WA', 'http://localhost:3000') . '/api?tujuan=' . $no_telp . '&pesan=' . $message);
            } catch (\Throwable $th) {
                return redirect()->back()->with('error', 'Pesan gagal dikirim');
            }
        }

        return redirect()->route('pertanyaan')->with('success', 'Tiket dengan id:' . $tiket->id . ' pertanyaan berhasil dikirim');
    }

    public function faq()
    {
        $data['faqs'] = Faq::all();
        return view('pengguna.pertanyaan.faq', $data);
    }
}

<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Tiket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TiketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // 
        if(auth()->user()->role == 'superadmin'){
            $data['tikets'] = Tiket::all();
            $data['kategori'] = ['UKT', 'beasiswa', 'kelulusan', 'PMB', 'perkuliahan', 'surat menyurat'];
        }else{
            // get permissions
            $permissions = auth()->user()->permissions->pluck('name')->toArray();
            $data['kategori'] = $permissions;
            $data['tikets'] = Tiket::whereIn('kategori', $permissions)->get();
        }

        if($request->get('kategori')){
            $data['tikets'] = Tiket::where('kategori', $request->get('kategori'))->get();
        }

        return view('master.modul.tiket.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'balasan' => 'required',
        ]);

        $tiket = Tiket::findOrFail($id);
        $tiket->update([
            'balasan' => $request->balasan,           
        ]);

        // send email
        Mail::to($tiket->user->email)->send(new \App\Mail\Tiket($tiket));

        return redirect()->route('modul-tiket.index')->with('success', 'Tiket berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

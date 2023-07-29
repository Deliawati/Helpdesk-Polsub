<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\KategoriLayanan;
use Illuminate\Http\Request;

class KategoriLayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data['kategori_layanans'] = KategoriLayanan::all();

        return view('master.kategori-layanan.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nama' => 'required',
        ]);

        KategoriLayanan::create($request->all());

        return redirect()->route('master-kategori-layanan.index')->with('success', 'Data berhasil ditambahkan');
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
            'nama' => 'required',
        ]);

        $kategori_layanan = KategoriLayanan::findOrFail($id);
        $kategori_layanan->update($request->all());

        return redirect()->route('master-kategori-layanan.index')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $kategori_layanan = KategoriLayanan::findOrFail($id);
        $kategori_layanan->delete();

        return redirect()->route('master-kategori-layanan.index')->with('success', 'Data berhasil dihapus');
    }
}

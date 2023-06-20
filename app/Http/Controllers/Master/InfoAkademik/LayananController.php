<?php

namespace App\Http\Controllers\Master\InfoAkademik;

use App\Http\Controllers\Controller;
use App\Models\LayananAkademik;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data['layanans'] = LayananAkademik::all();
        return view('master.info-akademik.layanan.index', $data);
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
        $request->validate([
            'nama' => 'required',
            // 'melalui' => 'required',
            'konfirmasi' => 'required',
        ]);

        LayananAkademik::create($request->all());

        return redirect()->route('master-layanan-akademik.index')->with('success', 'Layanan Akademik berhasil ditambahkan');
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
            // 'melalui' => 'required',
            'konfirmasi' => 'required',
        ]);

        LayananAkademik::find($id)->update($request->all());

        return redirect()->route('master-layanan-akademik.index')->with('success', 'Layanan Akademik berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        LayananAkademik::find($id)->delete();

        return redirect()->route('master-layanan-akademik.index')->with('success', 'Layanan Akademik berhasil dihapus');
    }
}

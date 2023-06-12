<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Tiket;
use Illuminate\Http\Request;

class TiketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        switch (auth()->user()->role) {
            case 'admin1':
                // get data tiket dengan kategori 'UKT', 'beasiswa', 'kelulusan'
                $data['tikets'] = Tiket::whereIn('kategori', ['UKT', 'beasiswa', 'kelulusan'])->get();
                break;
            case 'admin2':
                // get data tiket dengan kategori 'PMB', 'perkuliahan'
                $data['tikets'] = Tiket::whereIn('kategori', ['PMB', 'perkuliahan'])->get();
                break;
            case 'admin3':
                // get data tiket dengan kategori 'surat menyurat'
                $data['tikets'] = Tiket::where('kategori', 'surat menyurat')->get();
                break;
            default:
                $data['tikets'] = Tiket::all();
                break;
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

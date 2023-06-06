<?php

namespace App\Http\Controllers\Master\InfoAkademik;

use App\Http\Controllers\Controller;
use App\Models\KalenderAkademik;
use Illuminate\Http\Request;

class KalenderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data['kalenders'] = KalenderAkademik::all();
        return view('master.info-akademik.kalender.index', $data);
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
            'tahun_ajaran' => 'required|regex:/^\d{4}\/\d{4}$/',
            'file' => 'required|mimes:pdf|max:2048',
        ]);

        // store file to storage/app/public/kalender-akademik
        $file = $request->file('file');
        $file_name = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('public/kalender-akademik', $file_name);

        // store to database
        KalenderAkademik::create( [
            'tahun_ajaran' => $request->tahun_ajaran,
            'file' => $file_name,
        ]);

        return redirect()->route('master-kalender-akademik.index')->with('success', 'Kalender Akademik berhasil ditambahkan');
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
            'tahun_ajaran' => 'required|regex:/^\d{4}\/\d{4}$/',
            'file' => 'nullable|mimes:pdf|max:2048',
        ]);

        $kalender = KalenderAkademik::findOrFail($id);

        if ($request->hasFile('file')) {
            // delete old file
            unlink(storage_path('app/public/kalender-akademik/' . $kalender->file));

            // store new file
            $file = $request->file('file');
            $file_name = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/kalender-akademik', $file_name);

            // update to database
            $kalender->update([
                'tahun_ajaran' => $request->tahun_ajaran,
                'file' => $file_name,
            ]);
        } else {
            // update to database
            $kalender->update([
                'tahun_ajaran' => $request->tahun_ajaran,
            ]);
        }

        return redirect()->route('master-kalender-akademik.index')->with('success', 'Kalender Akademik berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $kalender = KalenderAkademik::findOrFail($id);

        // delete file
        unlink(storage_path('app/public/kalender-akademik/' . $kalender->file));

        // delete from database
        $kalender->delete();

        return redirect()->route('master-kalender-akademik.index')->with('success', 'Kalender Akademik berhasil dihapus');
    }
}

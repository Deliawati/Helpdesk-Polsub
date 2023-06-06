<?php

namespace App\Http\Controllers\Master\InfoAkademik;

use App\Http\Controllers\Controller;
use App\Models\PeraturanAkademik;
use Illuminate\Http\Request;

class PeraturanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data['peraturans'] = PeraturanAkademik::all();
        return view('master.info-akademik.peraturan.index', $data);
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
            'file' => 'required|mimes:pdf|max:2048',
        ]);
        
        // store file to storage/app/public/peraturan-akademik
        $file = $request->file('file');
        $file_name = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('public/peraturan-akademik', $file_name);

        // store to database
        PeraturanAkademik::create([
            'nama' => $request->nama,
            'file' => $file_name,
        ]);

        return redirect()->route('master-peraturan-akademik.index')->with('success', 'Peraturan Akademik berhasil ditambahkan');
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
            'file' => 'nullable|mimes:pdf|max:2048',
        ]);

        $peraturan = PeraturanAkademik::findOrFail($id);

        if ($request->hasFile('file')) {
            // store file to storage/app/public/peraturan-akademik
            $file = $request->file('file');
            $file_name = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/peraturan-akademik', $file_name);

            // delete old file
            unlink(storage_path('app/public/peraturan-akademik/' . $peraturan->file));

            // update to database
            $peraturan->update([
                'nama' => $request->nama,
                'file' => $file_name,
            ]);
        } else {
            // update to database
            $peraturan->update([
                'nama' => $request->nama,
            ]);
        }

        return redirect()->route('master-peraturan-akademik.index')->with('success', 'Peraturan Akademik berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $peraturan = PeraturanAkademik::findOrFail($id);

        // delete file
        unlink(storage_path('app/public/peraturan-akademik/' . $peraturan->file));

        // delete from database
        $peraturan->delete();

        return redirect()->route('master-peraturan-akademik.index')->with('success', 'Peraturan Akademik berhasil dihapus');
    }
}

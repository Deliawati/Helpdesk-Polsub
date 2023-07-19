<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\File;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data['faqs'] = Faq::all();
        return view('master.modul.faq.index', $data);
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
            'pertanyaan' => 'required',
            'jawaban' => 'required',
            'kategori' => 'required',
        ]);

        $faq = Faq::create($request->all());

        if ($request->hasFile('attachment')) {
            foreach ($request->attachment as $file) {
                $file = $file->store('public/faq');
                // trim public/faq/ from $file
                $file = substr($file, 11);
                File::create([
                    'parent_id' => $faq->id,
                    'nama' => $file,
                    'jenis' => 'faq',
                ]);
            }
        }

        return redirect()->route('modul-faq.index')->with('success', 'FAQ berhasil ditambahkan');
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
            'pertanyaan' => 'required',
            'jawaban' => 'required',
            'kategori' => 'required',
        ]);

        $faq = Faq::find($id)->update($request->all());

        if ($request->hasFile('attachment')) {
            foreach ($request->attachment as $file) {
                $file = $file->store('public/faq');
                // trim public/faq/ from $file
                $file = substr($file, 11);
                File::create([
                    'parent_id' => $id,
                    'nama' => $file,
                    'jenis' => 'faq',
                ]);
            }
        }

        return redirect()->route('modul-faq.index')->with('success', 'FAQ berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Faq::find($id)->delete();

        return redirect()->route('modul-faq.index')->with('success', 'FAQ berhasil dihapus');
    }
}

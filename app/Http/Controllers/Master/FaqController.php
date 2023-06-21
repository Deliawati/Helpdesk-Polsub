<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Faq;
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

        Faq::create($request->all());

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

        Faq::find($id)->update($request->all());

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

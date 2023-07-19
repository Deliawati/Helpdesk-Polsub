<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Chatbot;
use App\Models\File;
use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data['chatbots'] = Chatbot::all();
        return view('master.modul.chatbot.index', $data);
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
        ]);

        $chatbot = Chatbot::create([
            'pertanyaan' => $request->pertanyaan,
            'jawaban' => $request->jawaban,
        ]);

        foreach ($request->attachment as $file) {
            $file = $file->store('public/chatbot');
            // trim public/chatbot/ from $file
            $file = substr($file, 15);
            File::create([
                'parent_id' => $chatbot->id,
                'nama' => $file,
                'jenis' => 'chatbot',
            ]);
        }

        return redirect()->route('modul-chatbot.index')->with('success', 'Data berhasil ditambahkan');
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
        ]);

        Chatbot::find($id)->update([
            'pertanyaan' => $request->pertanyaan,
            'jawaban' => $request->jawaban,
        ]);

        foreach ($request->attachment as $file) {            
            $file = $file->store('public/chatbot');
            // trim public/chatbot/ from $file
            $file = substr($file, 15);
            File::create([
                'parent_id' => $id,
                'nama' => $file,
                'jenis' => 'chatbot',
            ]);
        }

        return redirect()->route('modul-chatbot.index')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Chatbot::find($id)->delete();

        return redirect()->route('modul-chatbot.index')->with('success', 'Data berhasil dihapus');
    }
}

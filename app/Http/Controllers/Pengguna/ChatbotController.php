<?php

namespace App\Http\Controllers\Pengguna;

use App\Http\Controllers\Controller;
use App\Models\Chatbot;
use FuzzyWuzzy\Fuzz;
use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    //
    public function index()
    {
        return view('pengguna.chatbot.index');
    }

    public function chat(Request $request)
    {
        // use fuzzy string matching to find the best match
        $fuzz = new Fuzz();
        $bestRatio = 30;
        $bestMatch = null;

        $chatbots = Chatbot::all();

        foreach ($chatbots as $chatbot) {
            $ratio = $fuzz->ratio($request->pertanyaan, $chatbot->pertanyaan);
            if ($ratio > $bestRatio) {
                $bestRatio = $ratio;
                $bestMatch = $chatbot;
            }
        }

        // if the best match is not null, return the answer
        if ($bestMatch) {
            return response()->json([
                'status' => 'success',
                'data' => [
                    'pertanyaan' => $bestMatch->pertanyaan,
                    'jawaban' => Chatbot::where('pertanyaan', $bestMatch->pertanyaan)->first()->jawaban,
                ],
            ]);
        }

        // if the best match is null, return the default answer
        return response()->json([
            'status' => 'success',
            'data' => [
                'pertanyaan' => $request->pertanyaan,
                'jawaban' => 'Maaf, saya tidak mengerti pertanyaan Anda.',
            ],
        ]);
    }
}

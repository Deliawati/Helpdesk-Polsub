<?php

namespace App\Http\Controllers\Pengguna;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    //
    public function index()
    {
        return view('pengguna.chatbot.index');
    }
}

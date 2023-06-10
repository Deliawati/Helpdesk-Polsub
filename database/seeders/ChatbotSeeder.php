<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChatbotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // get data from json file
        $json = file_get_contents(base_path('database/seeders/data/chatbot.json'));
        $data = json_decode($json);
        
        // insert data to database
        foreach ($data->percakapan as $obj) {
            \App\Models\Chatbot::create([
                'pertanyaan' => $obj->pertanyaan,
                'jawaban' => $obj->response,
            ]);
        }
    }    
}

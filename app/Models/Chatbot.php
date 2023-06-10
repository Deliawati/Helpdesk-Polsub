<?php

namespace App\Models;

use FuzzyWuzzy\Fuzz;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chatbot extends Model
{
    use HasFactory;

    protected $fillable = [
        'pertanyaan',
        'jawaban',
    ];

    public static function getBestMatch($query, $data)
    {
        $bestRatio = 0;
        $bestMatch = null;

        foreach ($data as $item) {
            $ratio = Fuzz::ratio($query, $item);
            if ($ratio > $bestRatio) {
                $bestRatio = $ratio;
                $bestMatch = $item;
            }
        }

        return $bestMatch;
    }
}

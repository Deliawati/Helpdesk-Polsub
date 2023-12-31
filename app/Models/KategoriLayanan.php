<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriLayanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
    ];

    public function faqs()
    {
        return $this->hasMany(Faq::class, 'kategori_id');
    }
}

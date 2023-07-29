<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $fillable = [
        'pertanyaan',
        'jawaban',
        'kategori_id',
    ];

    public function attachments()
    {
        return $this->hasMany(File::class, 'parent_id')->where('jenis', 'faq');
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriLayanan::class);
    }
}

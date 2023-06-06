<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LayananAkademik extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'melalui',
        'konfirmasi',
    ];
}

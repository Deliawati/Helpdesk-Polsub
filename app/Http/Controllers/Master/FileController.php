<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
    //
    public function deleteAttachment(string $id)
    {
        //
        File::find($id)->delete();

        return redirect()->back()->with('success', 'File berhasil dihapus');
    }
}

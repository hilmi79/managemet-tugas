<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function tugas($filename)
    {
        $path = storage_path('app/public/tugas/' . $filename);

        if (!file_exists($path)) {
            abort(404, 'File not found');
        }

        return response()->download($path);
    }

    public function jawaban($filename)
    {
        $path = storage_path('app/public/jawaban/' . $filename);

        if (!file_exists($path)) {
            abort(404, 'File not found');
        }

        return response()->download($path);
    }
}

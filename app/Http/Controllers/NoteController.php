<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'content' => 'required|string',
    ]);

    Note::updateOrCreate(
        ['dosen_id' => Auth::id()],
        ['content' => $request->content]
    );

    return redirect()->route('dashboard')->with('success', 'Catatan berhasil disimpan.');
}

}

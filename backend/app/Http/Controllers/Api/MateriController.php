<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Materi;

class MateriController extends Controller
{
    public function index()
    {
        $materi = Materi::all(); // atau paginate()
        return response()->json($materi);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'label' => 'required|string',
            'konten' => 'nullable|string',
            'gambar' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        // Cek dan simpan file jika ada
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('materi_gambar', 'public');
            $validated['gambar'] = $path; // simpan path ke DB
        }

        $materi = Materi::create($validated);

        return response()->json($materi, 201);
    }

}

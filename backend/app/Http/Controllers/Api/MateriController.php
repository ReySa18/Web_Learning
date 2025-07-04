<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Materi;

class MateriController extends Controller
{
    // GET /api/materis
    public function index()
    {
        // Ambil materi + relasi author
        $materis = Materi::all();
        return response()->json($materis);
    }

    // POST /api/materis
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'label' => 'required|string',
            'konten' => 'nullable|string',
            'gambar' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        // Simpan gambar jika ada
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('materi_gambar', 'public');
            $validated['gambar'] = $path;
        }

        // Simpan data ke database
        $materi = Materi::create($validated);

        return response()->json($materi, 201);
    }

    public function show($id)
    {
        $user = auth()->user(); // Ambil user login (siswa/admin)

        $materi = Materi::find($id);

        if (!$materi) {
            return response()->json(['message' => 'Materi tidak ditemukan'], 404);
        }

        return response()->json($materi);
    }

    public function update(Request $request, $id)
    {
        $materi = Materi::find($id);

        if (!$materi) {
            return response()->json(['message' => 'Materi tidak ditemukan'], 404);
        }

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'label' => 'required|string',
            'konten' => 'nullable|string',
            'gambar' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        // Jika ada file baru dikirim
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('materi_gambar', 'public');
            $validated['gambar'] = $path;
        }

        $materi->update($validated);

        return response()->json(['message' => 'Materi berhasil diperbarui', 'data' => $materi]);
    }

    public function destroy($id)
    {
        $materi = Materi::find($id);

        if (!$materi) {
            return response()->json(['message' => 'Materi tidak ditemukan'], 404);
        }

        $materi->delete();

        return response()->json(['message' => 'Materi berhasil dihapus']);
    }



}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HasilLatihan;

class HasilLatihanController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategori,id',
            'topik_id' => 'required|exists:topik,id',
            'skor' => 'required|integer|min:0|max:100',
            'jumlah_benar' => 'required|integer',
            'jumlah_salah' => 'required|integer',
            'tanggal_latihan' => 'required|date',
        ]);

        $validated['user_id'] = auth()->id(); // Ambil dari user login, BUKAN dari request

        if (!$validated['user_id']) {
            return response()->json(['message' => 'Unauthorized.'], 401);
        }

        $hasil = HasilLatihan::create($validated);

        return response()->json([
            'message' => 'Hasil latihan berhasil disimpan',
            'data' => $hasil
        ], 201);
    }

    public function index()
    {
        $userId = auth()->id();

        if (!$userId) {
            return response()->json(['message' => 'Unauthorized.'], 401);
        }

        $hasil = HasilLatihan::with(['kategori', 'topik'])
            ->where('user_id', $userId)
            ->orderByDesc('created_at')
            ->get();

        return response()->json($hasil);
    }

}

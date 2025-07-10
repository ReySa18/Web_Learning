<?php

namespace App\Http\Controllers;

use App\Models\Soal;
use Illuminate\Http\Request;

class SoalController extends Controller
{
    public function index()
    {
        $soals = Soal::with(['kategori', 'topik'])->latest()->get();
        return response()->json($soals);
    }

    public function show($id)
    {
        $soal = Soal::with(['kategori', 'topik'])->findOrFail($id);
        return response()->json($soal);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategori,id',
            'topik_id' => 'required|exists:topik,id',
            'pertanyaan' => 'required|string',
            'opsi_a' => 'required|string',
            'opsi_b' => 'required|string',
            'opsi_c' => 'required|string',
            'opsi_d' => 'required|string',
            'jawaban_benar' => 'required|in:A,B,C,D',
        ]);

        $soal = Soal::create($validated);

        return response()->json([
            'message' => 'Soal berhasil ditambahkan',
            'data' => $soal
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $soal = Soal::find($id);

        if (!$soal) {
            return response()->json(['message' => 'Soal tidak ditemukan'], 404);
        }

        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategori,id',
            'topik_id' => 'required|exists:topik,id',
            'pertanyaan' => 'required|string',
            'opsi_a' => 'required|string',
            'opsi_b' => 'required|string',
            'opsi_c' => 'required|string',
            'opsi_d' => 'required|string',
            'jawaban_benar' => 'required|in:A,B,C,D'
        ]);

        $soal->update($validated);

        return response()->json(['message' => 'Soal berhasil diperbarui'], 200);
    }


    public function destroy($id)
    {
        $soal = Soal::find($id);

        if (!$soal) {
            return response()->json(['message' => 'Soal tidak ditemukan'], 404);
        }

        $soal->delete();

        return response()->json(['message' => 'Soal berhasil dihapus'], 200);
    }

    public function getByKategoriAndTopik(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategori,id',
            'topik_id' => 'required|exists:topik,id',
        ]);

        $soals = Soal::where('kategori_id', $request->kategori_id)
                     ->where('topik_id', $request->topik_id)
                     ->with(['kategori', 'topik']) // jika ada relasi
                     ->get();

        return response()->json([
            'message' => 'Daftar soal berdasarkan kategori dan topik',
            'data' => $soals
        ]);
    }

    public function getLatihanList()
    {
        $kuisList = Soal::with(['kategori', 'topik'])
            ->select('kategori_id', 'topik_id')
            ->groupBy('kategori_id', 'topik_id')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $kuisList
        ]);
    }

}


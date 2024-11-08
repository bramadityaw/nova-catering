<?php

namespace App\Http\Controllers;

use App\Enums\KategoriPaket;
use App\Models\Paket;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    public function all(): JsonResponse
    {
        $pakets = DB::table('paket')
            ->select('id', 'nama', 'harga', 'kategori')
            ->get();

        return response()->json($pakets);
    }

    public function index(): JsonResponse
    {
        return response()->json(Paket::all());
    }

    public function store(Request $request): JsonResponse
    {
        $valid = $request->validate([
            'nama' => [],
            'harga' => ['integer'],
            'kategori' => [Rule::enum(KategoriPaket::class)],
            'items' => ['nullable', 'array' , 'exists:satuan,id'],
        ]);

        $paket = new Paket();
        $paket->nama = $valid['nama'];
        $paket->harga = $valid['harga'];
        $paket->kategori = $valid['kategori'];

        if (! $paket->save()) {
            return response()->json([
                'message' => "paket {$valid['nama']} gagal tersimpan",
            ], 500);
        }

        return response()->json([
            'message' => "paket $paket->nama berhasil disimpan",
        ]);
    }
}

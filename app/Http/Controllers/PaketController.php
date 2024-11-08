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

    public function show(Paket $paket) : JsonResponse
    {
        return response()->json($paket);
    }

    public function items(Paket $paket) : JsonResponse
    {
        $items = $paket->items()->get();
        return response()->json($items);
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
                'message' => "Paket {$valid['nama']} gagal tersimpan",
            ], 500);
        }

        $items = $valid['items'];

        if (! empty($items)) {
            $paket->items()->sync($items, false);
        }

        return response()->json([
            'message' => "Paket $paket->nama berhasil disimpan",
        ]);
    }

    public function update(Request $request, Paket $paket): JsonResponse
    {
        $valid = $request->validate([
            'nama' => [],
            'harga' => ['integer'],
            'kategori' => [Rule::enum(KategoriPaket::class)],
            'items' => ['nullable', 'array' , 'exists:satuan,id'],
        ]);

        $paket->nama = $valid['nama'];
        $paket->harga = $valid['harga'];
        $paket->kategori = $valid['kategori'];

        if (! $paket->save()) {
            return response()->json([
                'message' => "Paket {$valid['nama']} gagal diubah",
            ], 500);
        }

        $items = $valid['items'];

        if (! empty($items)) {
            $paket->items()->sync($items, false);
        }

        return response()->json([
            'message' => "Paket $paket->nama berhasil diubah",
        ]);
    }

}

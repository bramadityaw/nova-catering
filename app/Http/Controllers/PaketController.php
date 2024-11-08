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
        $menus = DB::table('menus')
            ->select('id', 'nama', 'harga', 'kategori')
            ->get();

        return response()->json($menus);
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

        $menu = new Paket();
        $menu->nama = $valid['nama'];
        $menu->harga = $valid['harga'];
        $menu->kategori = $valid['kategori'];

        if (! $menu->save()) {
            return response()->json([
                'message' => "Menu {$valid['nama']} gagal tersimpan",
            ], 500);
        }

        return response()->json([
            'message' => "Menu $menu->nama berhasil disimpan",
        ]);
    }
}

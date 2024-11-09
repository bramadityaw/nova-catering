<?php

namespace App\Http\Controllers;

use App\Enums\KategoriPaket;
use App\Models\Paket;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
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
            'nama' => ['required'],
            'harga' => ['required', 'integer'],
            'kategori' => ['required', Rule::enum(KategoriPaket::class)],
            'items' => ['nullable', 'array' , 'exists:satuan,id'],
            'foto' => [
                'required',
                'mimes:jpg,jpeg,png',
                'extensions:jpg,jpeg,png'
            ],
        ]);

        $paket = new Paket();
        $paket->nama = $valid['nama'];
        $paket->harga = $valid['harga'];
        $paket->kategori = $valid['kategori'];

        $file = $request->file('foto');
        if (! $file->isValid()) {
            return response()->json([
                'message' => 'File gagal terupload.'
            ], 400);
        }

        $nama_file = Str::kebab($valid['nama']);
        $ext = $file->extension();
        $path = $file->storeAs('partners', "$nama_file.$ext", 'public');

        $paket->foto = $path;

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
            'nama' => ['nullable'],
            'harga' => ['nullable', 'integer'],
            'kategori' => ['nullable', Rule::enum(KategoriPaket::class)],
            'items' => ['nullable', 'array' , 'exists:satuan,id'],
            'foto' => [
                'nullable',
                'mimes:jpg,jpeg,png',
                'extensions:jpg,jpeg,png'
            ],
        ]);

        $paket->nama = empty($valid['nama']) ? $paket->nama  : $valid['nama'];
        $paket->harga = empty($valid['harga']) ? $paket->harga  : $valid['harga'];
        $paket->kategori = empty($valid['kategori']) ? $paket->kategori  : $valid['kategori'];

        $file = $request->file('foto');
        if (! \is_null($file)) {
            if (! $file->isValid()) {
                return response()->json([
                    'message' => 'File gagal terupload.'
                ], 400);
            }

            $nama_file = Str::kebab($valid['nama']);
            $ext = $file->extension();
            $path = $file->storeAs('partners', "$nama_file.$ext", 'public');

            $paket->foto = $path;
        }

        // Only persist the model if it is modified
        if ($paket->isDirty() && ! $paket->save()) {
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

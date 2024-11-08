<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SatuanController extends Controller
{
    public function all() : JsonResponse
    {
        $satuans = DB::table('satuan')
            ->select('id', 'nama')
            ->get();
        return response()->json($satuans);
    }

    public function index() : JsonResponse
    {
        $satuans = Satuan::all();
        return response()->json($satuans);
    }

    public function show(Satuan $satuan) : JsonResponse
    {
        return response()->json($satuan);
    }

    public function store(Request $request) : JsonResponse
    {
        $satuan = Satuan::create([
            'nama' => $request->nama,
        ]);

        if (! $satuan) {
            return response()->json([
                'message' => "Gagal menyimpan $request->nama",
            ], 500);
        }

        return response()->json([
            'message' => "Berhasil menyimpan $request->nama",
        ]);
    }

    public function update(Request $request, Satuan $satuan) : JsonResponse
    {
        $old = $satuan->nama;

        $satuan->nama = $request->nama;

        if (! $satuan->save()) {
            return response()->json([
                'message' => "Gagal mengubah $old",
            ], 500);
        }

        return response()->json([
            'message' => "Berhasil mengubah '$old' menjadi '$satuan->nama'",
        ]);
    }

    public function destroy(Satuan $satuan) : JsonResponse
    {
        if (! $satuan->delete()) {
            return response()->json([
                'message' => "Gagal menghapus $satuan->nama",
            ], 500);
        }

        return response()->json([
            'message' => "Berhasil menghapus $satuan->nama",
        ]);
    }
}

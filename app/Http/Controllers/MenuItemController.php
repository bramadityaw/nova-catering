<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuItemController extends Controller
{
    public function all() : JsonResponse
    {
        $items = DB::table('menu_items', 'item')
            ->select('id', 'nama')
            ->get();
        return response()->json($items);
    }

    public function index() : JsonResponse
    {
        $items = MenuItem::all();
        return response()->json($items);
    }

    public function show(MenuItem $item) : JsonResponse
    {
        return response()->json($item);
    }

    public function store(Request $request) : JsonResponse
    {
        $item = MenuItem::create([
            'nama' => $request->nama,
        ]);

        if (! $item) {
            return response()->json([
                'message' => "Gagal menyimpan $request->nama",
            ], 500);
        }

        return response()->json([
            'message' => "Berhasil menyimpan $request->nama",
        ]);
    }

    public function update(Request $request, MenuItem $item) : JsonResponse
    {
        $old = $item->nama;

        $item->nama = $request->nama;

        if (! $item->save()) {
            return response()->json([
                'message' => "Gagal mengubah $old",
            ], 500);
        }

        return response()->json([
            'message' => "Berhasil mengubah '$old' menjadi '$item->nama'",
        ]);
    }

    public function destroy(MenuItem $item) : JsonResponse
    {
        if (! $item->delete()) {
            return response()->json([
                'message' => "Gagal menghapus $item->nama",
            ], 500);
        }

        return response()->json([
            'message' => "Berhasil menghapus $item->nama",
        ]);
    }
}

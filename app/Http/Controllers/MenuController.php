<?php

namespace App\Http\Controllers;

use App\Enums\KategoriMenu;
use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function all(): JsonResponse
    {
        $menus = DB::table('menus')
            ->select('id', 'nama', 'kategori', 'items')
            ->get();

        return response()->json($menus);
    }

    public function index(): JsonResponse
    {
        return response()->json(Menu::all());
    }

    public function store(Request $request): JsonResponse
    {
        $valid = $request->validate([
            'nama' => [],
            'harga' => ['integer'],
            'kategori' => [Rule::enum(KategoriMenu::class)],
            'items' => ['nullable', 'array' , 'exists:menu_items,id'],
        ]);

        $menu = new Menu();
        $menu->nama = $valid['nama'];
        $menu->harga = $valid['harga'];
        $menu->kategori = $valid['kategori'];

        foreach ($valid['items'] as $id) {
            $item = MenuItem::find($id);
            $menu->items()->save($item);
        }

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

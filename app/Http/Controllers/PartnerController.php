<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PartnerController extends Controller
{
    public function all() : JsonResponse
    {
        $partners = DB::table('partners')
            ->select('nama', 'logo')
            ->get();

        return response()->json($partners);
    }

    public function index() : JsonResponse
    {
        return response()->json(Partner::all());
    }

    public function show(Partner $partner) : JsonResponse
    {
        return response()->json($partner);
    }

    public function store(Request $request) : JsonResponse
    {
        $validated = $request->validate([
            'logo' => [
                'required',
                'mimes:jpg,jpeg,png',
                'extensions:jpg,jpeg,png'
            ],
            'nama' => ['required'],
        ]);

        $nama = $validated['nama'];

        $file = $request->file('logo');

        if (! $file->isValid()) {
            return response()->json([
                'message' => 'File gagal terupload.'
            ], 400);
        }

        $ext = $file->extension();
        $path = asset('/storage/' . $file->storeAs('partners', "$nama.$ext", 'public'));

        $partner = new Partner();
        $partner->nama = $nama;
        $partner->logo = $path;

        if (! $partner->save()) {
            return response()->json([
                'message' => "Partner $nama gagal tersimpan.",
            ], 500);
        }

        return response()->json([
            'message' => "Partner $nama tersimpan.",
        ]);
    }

    public function update(Request $request,Partner $partner) : JsonResponse
    {
        return response()->json();
    }

    public function destroy(Partner $partner) : JsonResponse
    {
        $nama = $partner->nama;

        if (! $partner->delete()) {
            return response()->json([
                'message' => "Partner $nama gagal terhapus.",
            ]);
        }

        return response()->json([
            'message' => "Partner $nama berhasil terhapus.",
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class AuthController extends Controller
{

    public function login(Request $request): JsonResponse
    {
        // Cek kredensial pengguna
        if (! Auth::attempt($request->only('name', 'password'))) {
            return response()->json([
                'message' => 'Gagal log in'
            ], 401);
        }
    
        // Ambil data pengguna yang login berdasarkan nama
        $user = User::where('name', $request->name)->firstOrFail();
    
        // Membuat token otentikasi
        $token = $user->createToken('auth_token')->plainTextToken;
        
        // Enkripsi ID pengguna
        $encryptedUserId = Crypt::encryptString($user->id);
    
        // Kirimkan token dan ID terenkripsi dalam respons
        return response()->json([
            'message' => 'Login success',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user_id' => $encryptedUserId // ID pengguna yang sudah dienkripsi
        ]);
    }
    


    public function logout(Request $request): JsonResponse
    {
        // Delete the user's tokens
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Berhasil log out'
        ]);
    }
}

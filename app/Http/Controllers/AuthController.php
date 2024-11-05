<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request) : JsonResponse
    {
        if (! Auth::attempt($request->only('name', 'password'))) {
            return response()->json([
                'message' => 'Gagal log in'
            ], 401);
        }

        $user = User::where('name', $request->name)->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login success',
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }

    public function logout() : JsonResponse
    {
        Auth::user()->tokens()->delete();

        return response()->json([
            'message' => 'Berhasil log out'
        ]);
    }
}

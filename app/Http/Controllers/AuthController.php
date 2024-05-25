<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // public function login(Request $request)
    // {
    //     $credentials = $request->only('email', 'password');
    //     if (Auth::attempt($credentials)) {
    //         return response()->json(['message' => 'Login successful'], 200);
    //     }
    //     return response()->json(['message' => 'Unauthorized'], 401);
    // }

    // public function logout()
    // {
    //     Auth::logout();
    //     return response()->json(['message' => 'Logout successful'], 200);
    // }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('AuthToken')->plainTextToken;
            return response()->json(['token' => $token, 'message' => 'Login successful'], 200);
        } else {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logout successful'], 200);
    }
}

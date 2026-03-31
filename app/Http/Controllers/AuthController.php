<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
     // 🔐 REGISTER
    public function register(Request $request)
    {
        $request->validate([
            'employe_number' => 'required|digits:6|unique:users,employe_number',
            'password' => 'required|digits:4'
        ]);

        $user = User::create([
            'employe_number' => $request->employe_number,
            'password' => Hash::make($request->password),
            'role' => 'employe'
        ]);

        return response()->json($user);
    }

    // 🔑 LOGIN
    public function login(Request $request)
    {
        $request->validate([
            'employe_number' => 'required|digits:6',
            'password' => 'required|digits:4'
        ]);

        $user = User::where('employe_number', $request->employe_number)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Identifiants invalides'
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }

    // 🚪 LOGOUT
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Déconnecté avec succès'
        ]);
    }


}

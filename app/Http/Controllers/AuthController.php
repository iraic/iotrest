<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('username', $request->username)->first();
        if (!$user || !password_verify($request->password, $user->password)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $payload = [
            'iss' => "iotrest",
            'sub' => $user->id,
            'iat' => time(),
            'exp' => time() + 60 * 60,
        ];
        $jwt = JWT::encode($payload, env('JWT_SECRET'), 'HS256');
        //return response()->json(['token' => $jwt]);
        return $jwt;
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|unique:users',
            'password' => 'required',
        ]);

        $user = new User;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->rol = 'U';
        $user->save();
        return response()->json($user, 201);
    }
}


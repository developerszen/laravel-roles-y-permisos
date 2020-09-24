<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    function login (Request $request) {
        $request->validate([
            'email' => 'required|exists:users',
            'password' => 'required|string',
        ]);

        $credentials = $request->only(['email', 'password']);

        $token = auth()->attempt($credentials);

        if($token) return response(compact('token'));

        return response([
            'error' => 'Unauthorized',
        ], 401);
    }

    function logout() {
        auth()->logout();

        return response([], 204);
    }

    function me() {
        return auth()->user();
    }
}

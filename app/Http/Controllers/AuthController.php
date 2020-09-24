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

        $token = auth()->attempt($request->only(['mobile_phone', 'password']));

        if($token) return response(compact('token'));

        return response([
            'error' => 'Unauthorized',
        ], 401);
    }

    function logout() {
        auth()->logout();

        return response([], 204);
    }
}

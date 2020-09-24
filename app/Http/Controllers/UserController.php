<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function index()
    {
        return User::latest()->paginate(8);
    }

    function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt('password'),
        ]);

        return $user;
    }

    function show(User $user)
    {
        return $user;
    }

    function update(Request $request, User $user)
    {
        $user->update([
            'enabled' => $request->has('enabled') ? true : false,
        ]);

        return $user;
    }
}

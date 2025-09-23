<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Register a new user
    public function register(Request $request)
    {
        // validate input
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|numeric|unique:users', 
            'password' => 'required|min:6'
            
        ]);

        // create new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // password encrypted
            'phone' => $request->phone,
        ]);

        return response()->json($user, 201);
    }

    // Login existing user
     public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json(['error' => 'Invalid Credentials'], 401);
        }

        $user = Auth::user();

        // Create Passport token
        $token = $user->createToken('MyAppToken')->accessToken;

        return response()->json([
            'token' => $token,
            'user'  => $user
        ]);
    }
}
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function register(Request $request)
    {

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'gender'     => ['required', Rule::in(['male', 'female'])],
            'birth_date' => 'nullable|date',
            'phone'      => 'nullable',
            'role'       => [Rule::in(['player', 'coach', 'admin'])],
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name'  => $validated['last_name'],
            'phone'      => $validated['phone'] ?? null,
            'name'       => $validated['first_name'] . ' ' . $validated['last_name'],
            'gender'     => $validated['gender'],
            'birth_date' => $validated['birth_date'],
            'role'       => $validated['role'],
            'email'      => $validated['email'],
            'password'   => bcrypt($validated['password']),
        ]);

        $token = $user->createToken('flutter_token')->plainTextToken;

        return response()->json([
            'user'  => $user,
            'token' => $token
        ], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken('flutter_token')->plainTextToken;

        return response()->json([
            'user'  => $user,
            'token' => $token
        ]);
    }



    public function user(Request $request)
    {
        return response()->json($request->user());
    }



    public function logout(Request $request)
    {
        if (!$request->user()) {
            return response()->json(['message' => 'Not authenticated'], 401);
        }

        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out']);
    }
}

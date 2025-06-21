<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $role = $request->query('role');

        $query = User::query();

        if ($role) {
            $query->where('role', $role);
        }

        $users = $query->get(['id', 'first_name', 'last_name', 'role', 'email']);

        $users->transform(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->first_name . ' ' . $user->last_name,
                'role' => $user->role,
                'email' => $user->email,
            ];
        });

        return response()->json($users);
    }
}

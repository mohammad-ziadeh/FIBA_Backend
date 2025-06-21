<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\Player;
use App\Models\User;


class PlayerController extends Controller
{
    public function store(Request $request, Team $team)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => 'required|string'
        ]);

        $playerUser = User::findOrFail($request->user_id);

        if ($playerUser->role !== 'player') {
            return response()->json(['message' => 'User is not a player'], 400);
        }

        $existing = $team->players()->where('user_id', $playerUser->id)->exists();
        if ($existing) {
            return response()->json(['message' => 'Player already assigned to this team'], 409); 
        }

        $player = Player::create([
            'user_id' => $playerUser->id,
            'team_id' => $team->id,
            'role' => $request->role,
        ]);

        return response()->json($player, 201);
    }


    public function destroy(Team $team, User $player)
    {
        $team->players()->where('user_id', $player->id)->delete();

        return response()->json(['message' => 'Player removed from team']);
    }
}

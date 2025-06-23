<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\Player;
use App\Models\User;
use Carbon\Carbon;

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




    // Search and suggestions methods

    private function getAgeCategory($birthDate)
    {
        if (!$birthDate) return 'adult';
        $age = Carbon::parse($birthDate)->age;
        return $age < 18 ? 'u18' : 'adult';
    }

    public function search(Request $request)
    {
        $query = $request->input('search');
        $gender = $request->input('gender');
        $ageCategory = $request->input('age_category');

        $players = User::where('role', 'player');

        if ($query) {
            $players = $players->where(function ($q) use ($query) {
                $q->where('first_name', 'like', "%$query%")
                    ->orWhere('last_name', 'like', "%$query%");
                    
            });
        }

        if ($gender && in_array($gender, ['male', 'female'])) {
            $players = $players->where('gender', $gender);
        }

        $players = $players->get();

        if ($ageCategory && in_array($ageCategory, ['adult', 'u18'])) {
            $players = $players->filter(function ($player) use ($ageCategory) {
                return $this->getAgeCategory($player->birth_date) === $ageCategory;
            })->values();
        }

        $result = $players->map(function ($player) {
            return [
                'id' => $player->id,
                'name' => trim($player->first_name . ' ' . $player->last_name),
                // 'city' => $player->city ?? '',
                'gender' => $player->gender,
                'age_category' => $this->getAgeCategory($player->birth_date),
            ];
        });

        return response()->json($result);
    }

    public function suggestions(Request $request)
    {
        $q = $request->input('q');

        if (!$q) {
            return response()->json([]);
        }

        $suggestions = User::select('first_name', 'last_name')
            ->where('role', 'player')
            ->where(function ($query) use ($q) {
                $query->where('first_name', 'like', "%$q%")
                    ->orWhere('last_name', 'like', "%$q%");

            })
            ->limit(10)
            ->get()
            ->map(fn($player) => trim($player->first_name . ' ' . $player->last_name))
            ->unique()
            ->values();


        return response()->json($suggestions);
    }
}

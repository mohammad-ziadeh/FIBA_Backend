<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Load relationships
        $user->load([
            'player.team',
            'player.events' => function ($query) {
                $query->withPivot('points');
            }
        ]);

        $player = $user->player;

        $events = [];

        if ($player) {
            $events = $player->events->map(function ($event) use ($player) {
                return [
                    'event_name' => $event->title,
                    'points' => $event->pivot->points ?? 0,
                    'team_name' => $player->team?->name ?? null,
                    'date_range' => $event->start_date->format('M d, Y') . ' - ' . $event->end_date->format('M d, Y'),
                ];
            });
        }

        return response()->json([
            'id' => $user->id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'name' => $user->first_name . ' ' . $user->last_name,
            'email' => $user->email,
            'gender' => $user->gender,
            'birth_date' => $user->birth_date,
            'role' => $user->role,
            'points' => $user->points ?? 0,
            'rank' => $user->rank_title,
            'avatar_url' => $user->avatar_url,
            'background_url' => $user->background_url,
            'events' => $events,
            'badges' => $this->getBadges($user),
        ]);
    }

    protected function getBadges($user)
    {
        $points = $user->points ?? 0;

        return [
            ['title' => 'Rookie', 'unlocked' => $points >= 0],
            ['title' => 'Pro Player', 'unlocked' => $points >= 100],
            ['title' => 'All-Star', 'unlocked' => $points >= 200],
            ['title' => 'Elite', 'unlocked' => $points >= 350],
            ['title' => 'Legend', 'unlocked' => $points >= 500],
        ];
    }



public function uploadImage(Request $request)
{
    $request->validate([
        'type' => 'required|in:avatar_url,background_url',
        'image' => 'required|image|max:2048',
    ]);

    $user = \App\Models\User::find(auth()->id());

    $path = $request->file('image')->store('profile_images', 'public');

    $user->{$request->type} = asset('storage/' . $path);
    $user->save();

    return response()->json(['message' => 'Image updated successfully']);
}
}

<?php

namespace App\Http\Controllers\Api;


use App\Models\Team;
use App\Models\NextEvent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TeamController extends Controller
{
    public function index()
    {
        return Team::with(['players.user', 'events'])
            ->where('coach_id', auth()->id())
            ->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'location' => 'required|string',
        ]);

        $team = Team::create([
            'name' => $request->name,
            'location' => $request->location,
            'coach_id' => auth()->id(),
        ]);

        return response()->json($team, 201);
    }

    public function destroy(Team $team)
    {
        if ($team->coach_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $team->delete();
        return response()->noContent();
    }

    public function assignToEvent(Team $team, NextEvent $event)
    {
        if ($team->coach_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $oldAssignedTeam = Team::where('coach_id', auth()->id())
            ->whereHas('events', function ($query) use ($event) {
                $query->where('event_id', $event->id);
            })
            ->first();

        if ($oldAssignedTeam && $oldAssignedTeam->id !== $team->id) {
            $oldAssignedTeam->events()->detach($event->id);
        }

        $team->events()->syncWithoutDetaching([$event->id]);

        return response()->json(['message' => 'Team assigned to event']);
    }



    public function update(Request $request, Team $team)
    {
        if ($team->coach_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'name' => 'required|string',
            'location' => 'required|string',
        ]);

        $team->update([
            'name' => $request->name,
            'location' => $request->location,
        ]);

        return response()->json($team);
    }
}

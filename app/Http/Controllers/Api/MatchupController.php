<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\NextEvent;
use Illuminate\Http\Request;

class MatchupController extends Controller
{
    public function index(Request $request)
    {
        $events = NextEvent::with([
            'teams:id,name',              // only id and name
            'matchups' => function ($q) {
                $q->select('id', 'event_id', 'team_a_id', 'team_b_id', 'match_time');
            },
            'matchups.teamA:id,name',
            'matchups.teamB:id,name',
        ])
        ->get(['id', 'title', 'event_code']);

        return response()->json($events);
    }

    public function show($id)
    {
        $matchup = \App\Models\Matchup::with([
            'teamA:id,name',
            'teamB:id,name',
        ])->findOrFail($id);

        return response()->json($matchup);
    }
}

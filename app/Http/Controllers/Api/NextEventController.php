<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\NextEvent;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Team;
use Illuminate\Http\JsonResponse;

class NextEventController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(
            NextEvent::where('start_date', '>=', Carbon::today())
                ->orderBy('start_date', 'asc')
                ->take(5)
                ->get()
        );
    }

    public function show(int $id): JsonResponse
    {
        $event = NextEvent::find($id);

        if (!$event) {
            return response()->json(['message' => 'Event not found'], 404);
        }

        return response()->json($event);
    }






    public function search(Request $request): JsonResponse
    {
        $query = NextEvent::query();

        if ($request->filled('search')) {
            $searchTerm = trim($request->search);
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                    ->orWhere('location', 'like', "%{$searchTerm}%")
                    ->orWhere('event_code', 'like', "%{$searchTerm}%");  // changed here
            });
        }

        if ($request->filled('season') && $request->season !== 'Any season') {
            $query->where('event_code', $request->season);
        }

        if ($request->filled('location') && $request->location !== 'Any location') {
            $query->where('location', $request->location);
        }

        if ($request->filled('filter')) {
            $now = now();
            if ($request->filter === 'upcoming') {
                $query->where('start_date', '>', $now);
            } elseif ($request->filter === 'past') {
                $query->where('end_date', '<=', $now);
            } elseif ($request->filter === 'ongoing') {
                $query->where('start_date', '<=', $now)
                    ->where('end_date', '>=', $now);
            }
        }

        $query->orderBy('start_date');

        return response()->json($query->get());
    }

    public function suggestions(Request $request): JsonResponse
    {
        $query = $request->get('query');

        $suggestions = NextEvent::query()
            ->where('title', 'like', '%' . $query . '%')
            ->orWhere('location', 'like', '%' . $query . '%')
            ->orWhere('event_code', 'like', '%' . $query . '%')  // changed here
            ->limit(4)
            ->pluck('title');

        return response()->json($suggestions);
    }


    public function getTeamsAssignedToEvent(NextEvent $event)
    {
        $teams = Team::whereHas('events', function ($query) use ($event) {
            $query->where('event_id', $event->id);
        })->get();

        return response()->json($teams);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\NextEvent;
use Illuminate\Http\JsonResponse;

class NextEventController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(NextEvent::latest()->take(5)->get());
    }

    public function show(int $id): JsonResponse
    {
        $event = NextEvent::find($id);

        if (!$event) {
            return response()->json(['message' => 'Event not found'], 404);
        }

        return response()->json($event);
    }
}

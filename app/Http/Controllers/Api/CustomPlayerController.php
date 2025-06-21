<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CustomPlayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

// class CustomPlayerController extends Controller
// {
//     public function store(Request $request, $teamId)
//     {
//         $validator = Validator::make($request->all(), [
//             'name' => 'required|string|max:255',
//         ]);

//         if ($validator->fails()) {
//             return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
//         }

//         $player = CustomPlayer::create([
//             'team_id' => $teamId,
//             'name' => $request->input('name'),
//         ]);

//         return response()->json(['message' => 'Player added successfully', 'player' => $player], 201);
//     }
// }

<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpertTeamController extends Controller
{
    public function getAll(): JsonResponse
    {
        $expertTeams = DB::table('expert_teams')
            ->join('staff_positions', 'expert_teams.team_id', '=', 'staff_positions.position_id')
            ->select('staff_positions.name as staff_position_name', 'expert_teams.*')
            ->get();

        if ($expertTeams->count() <= 0):
            return response()->json([
                'status' => 'success',
                'message' => 'Expert teams not found'
            ], 404);
        endif;

        return response()->json([
            'status' => 'success',
            'data' => $expertTeams
        ], 200);
    }
}

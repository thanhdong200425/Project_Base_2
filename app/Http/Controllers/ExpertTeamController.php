<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpertTeamController extends Controller
{
    public function getAll(): JsonResponse
    {
        $expertTeams = DB::table('expert_team')
            ->join('staff_position', 'expert_team.position_id', '=', 'staff_position.position_id')
            ->select('staff_position.name as staff_position_name', 'expert_team.*')
            ->get();

        if ($expertTeams->count() <= 0):
            return response()->json([
                'status' => false,
                'data' => 'Expert teams not found'
            ], 404);
        endif;

        return response()->json([
            'status' => true,
            'data' => $expertTeams
        ], 200);
    }
}

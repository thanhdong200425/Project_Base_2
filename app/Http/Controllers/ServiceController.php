<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    public function getAll(): JsonResponse
    {
        $services = DB::table('services')
            ->select('services.*', 'staff_positions.name as staff_position_name')
            ->join('staff_positions', 'services.team_id', '=', 'staff_positions.position_id')
            ->get();

        if ($services->count() <= 0):
            return response()->json([
                'status' => 'error',
                'message' => 'No service found'
            ], 404);
        endif;

        return response()->json([
            'status' => 'success',
            'message' => 'Get all services successfully',
            'data' => $services
        ], 200);
    }
}

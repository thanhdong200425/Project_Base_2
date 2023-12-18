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
            ->select('services.*', 'staff_position.name as staff_position_name')
            ->join('staff_position', 'services.teamid', '=', 'staff_position.position_id')
            ->get();

        if ($services->count() <= 0):
            return response()->json([
                'status' => false,
                'data' => 'No service found'
            ], 404);
        endif;

        return response()->json([
            'status' => true,
            'data' => $services
        ], 200);
    }
}

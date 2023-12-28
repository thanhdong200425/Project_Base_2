<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CountController extends Controller
{

    public function getExpertTeam(): JsonResponse
    {
        $data = DB::table('expert_team')->count();
        if ($data == 0):
            return response()->json([
                "status" => true,
                "data" => 0
            ]);
        endif;

        return response()->json([
            "status" => true,
            "data" => $data
        ]);
    }

    public function getUser(): JsonResponse
    {
        $data = DB::table('users')->count();
        if ($data == 0):
            return response()->json([
                "status" => true,
                "data" => 0
            ]);
        endif;

        return response()->json([
            "status" => true,
            "data" => $data
        ]);
    }

    public function getProduct(): JsonResponse
    {
        $data = DB::table('product')->count();
        if ($data == 0):
            return response()->json([
                "status" => true,
                "data" => 0
            ]);
        endif;

        return response()->json([
            "status" => true,
            "data" => $data
        ]);
    }

    public function getService(): JsonResponse
    {
        $data = DB::table('services')->count();
        if ($data == 0):
            return response()->json([
                "status" => true,
                "data" => 0
            ]);
        endif;

        return response()->json([
            "status" => true,
            "data" => $data
        ]);
    }

    public function getPendingBill(): JsonResponse
    {
        $data = DB::table('bill')
                ->where('status', '=', 0)
                ->count();
        if ($data == 0):
            return response()->json([
                "status" => true,
                "data" => 0
            ]);
        endif;

        return response()->json([
            "status" => true,
            "data" => $data
        ]);
    }

    public function getPendingService(): JsonResponse
    {
        $data = DB::table('user_service')
                ->where('status', '=', 0)
                ->count();
        if ($data == 0):
            return response()->json([
                "status" => true,
                "data" => 0
            ]);
        endif;

        return response()->json([
            "status" => true,
            "data" => $data
        ]);
    }

    public function getPendingPaidService(): JsonResponse
    {
        $data = DB::table('user_service')
                ->where('payment_status', '=', 0)
                ->count();
        if ($data == 0):
            return response()->json([
                "status" => true,
                "data" => 0
            ]);
        endif;

        return response()->json([
            "status" => true,
            "data" => $data
        ]);
    }
}

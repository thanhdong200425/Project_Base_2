<?php

namespace App\Http\Controllers;

use App\Models\Service;
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
            ]);
        endif;

        return response()->json([
            'status' => true,
            'data' => $services
        ], 200);
    }

    public function addService(Request $request): JsonResponse
    {
        $service = new Service;
        $service->fill($request->only([
            'name', 'slug', 'icon', 'dersc', 'content', 'cost', 'teamid', 'created_at'
        ]));
        $data = $service->save();

        if ($data):
            return response()->json([
                "status" => true
            ]);
        endif;

        return response()->json([
            "status" => false
        ]);


    }

    public function deleteService(Request $request): JsonResponse
    {
        $data = DB::table('services')
            ->where('id', '=', $request->serviceid)
            ->delete();

        if ($data != 0):
            return response()->json([
                "status" => true,
            ]);
        endif;

        return response()->json([
            "status" => false
        ]);
    }

    public function getUnpaidService(): JsonResponse
    {
        $data = DB::table('user_service')
            ->join('users', 'users.id', '=', 'user_service.userid')
            ->join('services', 'services.id', '=', 'user_service.serviceid')
            ->get([
                'user_service.serviceid', 'user_service.userid', 'user_service.status',
                'user_service.payment_status', 'user_service.created_at', 'users.email',
                'services.name as serviceName'
            ]);

        if ($data->count() == 0):
            return response()->json([
                "status" => false,
                "data" => 0
            ]);
        endif;

        return response()->json([
            "status" => true,
            "data" => $data
        ]);
    }

    public function approvePaymentStatus(Request $request): JsonResponse
    {
        $data = DB::table('user_service')
            ->where('userid', '=', $request->userid)
            ->where('serviceid', '=', $request->serviceid)
            ->update([
                "payment_status" => 1,
                "updated_at" => date("Y-m-d H:i:s")
            ]);

        if ($data != 0):
            return response()->json([
                "status" => true,
            ]);
        endif;

        return response()->json([
            "status" => false
        ]);

    }

    public function updateService(Request $request): JsonResponse
    {
        $data = DB::table('services')
            ->where('id', '=', $request->serviceid)
            ->update([
                'name' => $request->name,
                'slug' => $request->slug,
                'icon' => $request->icon,
                'dersc' => $request->dersc,
                'content' => $request->content,
                'cost' => $request->cost,
                'teamid' => $request->team_id,
                'update_at' => date("Y-m-d H:i:s")
            ]);

        if ($data != 0):
            return response()->json([
                'status' => true,
                'data' => 1
            ]);
        endif;

        return response()->json([
            "status" => false,
            "data" => 0
        ]);
    }
}

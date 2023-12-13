<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function getAll(): JsonResponse
    {
        $users = User::all();
        if ($users->count() == 0) {
            return response()->json([
                'status' => false,
                'data' => []
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $users
        ], 200);
    }

    public function update(Request $request): JsonResponse
    {
        $status = [0, 1, 2];
        $user = DB::table('users')->where('id', $request->id)->first();

        if ($user != null) {
            if (!in_array($request->status, $status)):
                return response()->json([
                    'status' => false,
                    'data' => []
                ]);
            endif;
            DB::table('users')->where('id', $request->id)->update([
                'status' => $request->status
            ]);
            return response()->json([
                'status' => true,
                'data' => $user
            ]);
        }

        return response()->json([
                'status' => false,
                'data' => []
            ]
        );
    }

    public function getServices(Request $request): JsonResponse
    {
        $userId = $request->id;


        $result = DB::table('user_services')
            ->where('user_services.user_id', '=', $userId)
            ->where('user_services.status', '=', '0')
            ->orWhere('user_services.status', '=', '1')
            ->join('users', 'user_services.user_id', '=', 'users.id')
            ->join('services', 'services.service_id', '=', 'user_services.service_id')
            ->join('timeworkings', 'timeworkings.timeworking_id', '=', 'user_services.period_time_id')
            ->get([
                'user_services.*', 'users.fullname', 'services.name as service_name', 'timeworkings.timeworking'
            ]);


        if ($result->isEmpty()):
            return response()->json([
                'status' => false,
                'data' => []
            ], 404);
        endif;

        return response()->json([
            'status' => true,
            'data' => $result
        ]);
    }
}

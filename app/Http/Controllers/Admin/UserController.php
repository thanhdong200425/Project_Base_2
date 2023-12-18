<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Timeworking;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isEmpty;

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

    public function getServices($userId, $status): mixed
    {
        $result = DB::table('user_service')
            ->where('user_service.userid', '=', $userId)
            ->where('user_service.status', '=', $status)
            ->join('users', 'user_service.userid', '=', 'users.id')
            ->join('services', 'services.id', '=', 'user_service.serviceid')
            ->join('timeworking', 'timeworking.id', '=', 'user_service.periodTime')
            ->get([
                'services.*', 'user_service.userid', 'user_service.serviceid', 'user_service.status',
                'user_service.register_day', 'user_service.periodTime', 'user_service.payment_status', 'timeworking.*'
            ]);

        if ($result->isEmpty()):
            return false;
        endif;

        return $result;
    }

    public function getPendingServicesOfUser(Request $request): JsonResponse
    {
        $result = $this->getServices($request->id, '0');
        if ($result === false):
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

    public function getAcceptedServicesOfUser(Request $request): JsonResponse
    {
        $result = $this->getServices($request->id, '1');
        if ($result === false):
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

    public function getTimeWorking(): JsonResponse
    {

        $time = Timeworking::all();
        if ($time == []):
            return response()->json([
                'status' => false,
                'data' => []
            ], 400);
        endif;

        return response()->json([
            'status' => true,
            'data' => $time
        ]);
    }

    public function getPendingServices(): JsonResponse
    {
        $pendingServices = DB::table('user_service')
            ->join('services', 'user_service.serviceid', '=', 'services.id')
            ->join('users', 'user_service.userid', '=', 'users.id')
            ->where('user_service.status', '=', '0')
            ->get([
                'services.*', 'user_service.*', 'users.fullname', 'users.email as email'
            ]);

        if ($pendingServices === null):
            return response()->json([
                'status' => false,
                'data' => []
            ], 404);
        endif;

        return response()->json([
            'status' => true,
            'data' => $pendingServices
        ]);
    }

    public function updateService(Request $request): JsonResponse
    {
        $getService = DB::table('user_service')
            ->where('userid', '=', $request->userid)
            ->where('serviceid', '=', $request->serviceid)
            ->where('status', '=', 0)
            ->get('user_service.*');


        if (count($getService) == 0):
            return response()->json([
                'status' => false,
                'data' => []
            ], 404);
        endif;

        //        dd($getService);

        DB::table('user_service')
            ->where('userid', '=', $request->userid)
            ->where('serviceid', '=', $request->serviceid)
            ->update([
                'status' => 1,
                'updated_at' => now()
            ]);

        $result = DB::table('user_service')
            ->where('userid', '=', $request->userid)
            ->where('serviceid', '=', $request->serviceid)
            ->get('user_service.*');

        return response()->json([
            'status' => true,
            'data' => $result
        ]);
    }


}
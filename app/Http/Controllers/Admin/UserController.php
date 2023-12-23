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
        $user = User::where('id', $request->id)->first();

        if ($user != []) {
            if (!in_array($request->status, $status)):
                return response()->json([
                    'status' => false,
                    'data' => []
                ], 404);
            endif;
            // Update status
            $user->status = $request->status;
            $user->save();

            return response()->json([
                'status' => true,
                'data' => $user
            ]);
        }

        return response()->json([
            'status' => false,
            'data' => []
        ], 404);
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

    public function getServiceStatus(Request $request): JsonResponse
    {
        $result = DB::table('user_service')
            ->where('user_service.userid', '=', $request->userid)
            ->where('user_service.serviceid', '=', $request->serviceid)
            ->get('user_service.status');

        if ($result->count() <= 0):
            return response()->json([
                'status' => false,
                'data' => []
            ]);
        endif;

        return response()->json([
            'status' => true,
            'data' => $result
        ]);
    }

    public function getUserWithCondition($id): mixed
    {
        $users = DB::table('users')
            ->where('decentralization_id', '=', $id)
            ->get([
                'id', 'fullname', 'email', 'thumbnail', 'dob', 'address', 'phone', 'about_content', 'contact_facebook',
                'contact_twitter', 'contact_linkedin', 'contact_pinterest', 'status', 'created_at'
            ]);

        if ($users->count() <= 0):
            return false;
        endif;

        return $users;
    }

    public function getUsers(): JsonResponse
    {
        $users = $this->getUserWithCondition(2);
        if ($users == false):
            return response()->json([
                'status' => false,
                'data' => []
            ], 404);
        endif;

        return response()->json([
            'status' => true,
            'data' => $users
        ]);
    }

    public function getCompetentPersonnels(): JsonResponse
    {
        $result = $this->getUserWithCondition(3);
        if ($result == false):
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

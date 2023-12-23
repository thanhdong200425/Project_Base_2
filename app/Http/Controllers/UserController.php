<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Laravel\Sanctum\HasApiTokens;

class UserController extends Controller
{


    public function sign_in(Request $request): JsonResponse
    {
        $user = User::where('email', $request->email)->first();
        if ($user != null && Hash::check($request->password, $user->password)):
            return response()->json([
                'status' => true,
                'data' => $user,
            ]);
        endif;

        return response()->json([
            'status' => false,
            'data' => "User not found",
        ]);
    }


    public function sign_up(Request $request): JsonResponse
    {
        if ($request->has('confirm_password')) {
            if ($request->password === $request->confirm_password) {
                $user = DB::table('users')->insert([
                    'fullname' => $request->fullname,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'status' => 0
                ]);

                if ($user) {
                    return response()->json([
                        'status' => true,
                        'data' => "Added"
                    ], 200);
                }

                return response()->json([
                    'status' => false,
                    'data' => 'Error when add'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'data' => 'Password must be match'
                ]);
            }
        }

        return response()->json([
            'status' => false,
            'data' => "Something went wrong"
        ]);
    }

    public function update(Request $request): JsonResponse
    {
        $user = User::find($request->id);

        if ($user == null):
            return response()->json([
                'status' => false,
                'data' => []
            ]);
        endif;

        $user->fill($request->all());
        $user->save();

        return response()->json([
            'status' => true,
            'data' => $user
        ], 200);
    }

    public function sign_out(): JsonResponse
    {
        Auth::logout();
        return response()->json([
            'status' => true,
            'data' => 'Successfully log out'
        ]);
    }

    public function registry(Request $request): JsonResponse
    {
        $result = DB::table('user_service')->insert([
            'userid' => $request->userid,
            'serviceid' => $request->serviceid,
            'periodTime' => $request->periodTime,
            'register_day' => $request->register_day,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        $data = DB::table('user_service')
            ->where('userid', '=', $request->userid)
            ->where('serviceid', '=', $request->serviceid)
            ->get();

        if ($result === true):
            return response()->json([
                'status' => true,
                'data' => $data
            ]);
        endif;

        return response()->json([
            'status' => false,
            'data' => []
        ]);
    }

    public function cancelService(Request $request): JsonResponse
    {
        $data = DB::table('user_service')
            ->where('userid', '=', $request->userid)
            ->where('serviceid', '=', $request->serviceid)
            ->delete();

        if ($data != 1):
            return response()->json([
                'status' => false,
                'data' => $data
            ]);
        endif;

        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }

    public function updateService(Request $request)
    {
        $data = DB::table('user_service')
            ->where('userid', '=', $request->userid)
            ->where('serviceid', '=', $request->serviceid)
            ->update([
                'periodTime' => $request->periodTime,
                'register_day' => $request->register_day,
                'updated_at' => date('Y-m-d H:i:s')
            ]);

        if ($data == 0):
            return response()->json([
                'status' => false,
                'data' => []
            ]);
        endif;

        return response()->json([
            'status' => true,
            'data' => $data
        ]);




    }

}

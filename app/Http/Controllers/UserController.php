<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{


    public function sign_in(Request $request): JsonResponse
    {
        $user = User::where('email', $request->email)->get();
        if ($user->count() > 0) {
            return response()->json([
                'message' => "OK",
                'user' => $user,
            ], 200);
        }

        return response()->json([
            'status' => 404,
            'message' => "User not found",
        ], 404);
    }


    public function sign_up(Request $request): JsonResponse
    {
        if ($request->has('confirm_password')) {
            if ($request->password === $request->confirm_password) {
                $user = DB::table('users')->insert([
                    'fullname' => $request->fullname,
                    'email' => $request->email,
                    'password' => $request->password,
                    'status' => 0
                ]);

                if ($user) {
                    return response()->json([
                        'status' => 200,
                        'message' => "Added"
                    ], 200);
                }

                return response()->json([
                    'status' => 400,
                    'message' => 'Error when add'
                ], 400);
            } else {
                return response()->json([
                    'status' => 400,
                    'message' => 'Password must be match'
                ], 400);
            }
        }

        return response()->json([
            'status' => 400,
            'message' => "Something went wrong"
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if ($user->count() == 0):
            return response()->json([
                'status' => 'Success',
                'message' => 'No user found'
            ], 400);
        endif;

        $user->fullname = $request->fullname;
        $user->save();

        return response()->json([
            'status' => 'Success',
            'message' => 'Updated'
        ], 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
        ], 404);
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
                ], 400);
            } else {
                return response()->json([
                    'status' => false,
                    'data' => 'Password must be match'
                ], 400);
            }
        }

        return response()->json([
            'status' => false,
            'data' => "Something went wrong"
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if ($user->count() == 0):
            return response()->json([
                'status' => false,
                'data' => 'No user found'
            ], 400);
        endif;

        $user->fill($request->all());
        $user->save();

        return response()->json([
            'status' => true,
            'data' => 'Updated'
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
}

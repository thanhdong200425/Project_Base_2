<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    // public function index()
    // {
    //     $users = User::all();
    //     if ($users) {
    //         return response()->json([
    //             'status' => 200,
    //             'users' => $users
    //         ], 200);
    //     }

    //     return response()->json([
    //         'status' => 500,
    //         'message' => 'User not found'
    //     ], 500);
    // }

    public function sign_in(Request $request)
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

    public function sign_up(Request $request)
    {
        $user = DB::table('users')->insert([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'password' => $request->password,
            'status' => 0
        ]);

        if($user) {
            return response()->json([
                'status' => 200,
                'user' => $user
            ],200);
        }
        return response()->json([
            'status' => 400,
            'message' => 'Something went wrong'
        ], 400);
    }
}

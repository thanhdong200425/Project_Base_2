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
}

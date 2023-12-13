<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;

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
        $user = User::find($request->id);
        if ($user->count() == 0):
            return response()->json([
                'status' => false,
                'data' => []
            ]);
        endif;

        if (!in_array($request->status, $status)):
            return response()->json([
                'status' => false,
                'data' => []
            ]);
        endif;

        $user->status = $request->status;
        if ($user->save()):
            return response()->json([
                'status' => true,
                'data' => $user
            ]);
        endif;

        return response()->json([
                'status' => false,
                'data' => []
            ]
        );


    }
}
